<?php

class PersonController extends AdminController{

    /**
     *  persons admin homepage - athletes and coaches
     */
    public function getIndex()
    {
        $this->layout->content = View::make('admin.osobe.index');
    }

    /**
     *  new person form output
     */
    public function getNova()
    {
        //get all categories from DB to populate dropdown
        $person_categories = PersonCategory::orderBy('id')->lists('category_name', 'id');
        $this->layout->content = View::make('admin.osobe.nova', compact('person_categories'));
    }

    /**
     * @return mixed
     * post data for adding new person
     */
    public function postNova()
    {
        //get form data
        $person_images = Input::file('person_images');
        $person_data = array('person_full_name' => e(Input::get('person_full_name')),
                             'person_description' => e(Input::get('person_description')),
                             'person_birthday' => e(Input::get('person_birthday')),
                             'person_category' => e(Input::get('person_category'))
                        );
        $is_athlete = ($person_data['person_category'] == 7 ? 'no' : 'yes');
        $success = true;
        $error_list = null;

        /*
         *  validation
         */
        $validator = Validator::make($person_data, Person::$rules, Person::$messages);
        if($validator->fails()){
            $error_list = $validator->messages();
            $success = false;
        }

        if($person_images == true){
            foreach($person_images as $img){
                $validator_images = Validator::make(array('images' => $img), PersonImage::$rules, PersonImage::$messages);
                if($validator_images->fails()){
                    $error_list = $validator->messages()->merge($validator_images->messages());
                    $success = false;
                }
            }
        }

        //store to database if no errors
        if($success == true){
            //convert input date to timestamp format
            $birthday_date = new DateTime($person_data['person_birthday']);

            $person = new Person;
            $person->person_full_name = $person_data['person_full_name'];
            $person->person_description = $person_data['person_description'];
            $person->person_birthday = $birthday_date->format('Y-m-d');;
            $person->category_id = $person_data['person_category'];
            $person->is_athlete = $is_athlete;
            $person->save();

            $personID = $person->id;
            $personName = safe_name($person->person_full_name);

            //images
            if($person_images == true && $person_images[0] != null){
                //check for image directory
                $path = public_path().'/person_uploads/'.$personID.'/';
                if(!File::exists($path)){
                    File::makeDirectory($path, 0777);
                }

                foreach($person_images as $img){
                    $file_name = $personName.'_'.Str::random(5);
                    $file_exstension = $img->getClientOriginalExtension();
                    $full_name = $file_name.'.'.$file_exstension;
                    $file_size = $img->getSize();

                    $file_uploaded = $img->move($path, $full_name);
                    if($file_uploaded){
                        $image = new PersonImage;
                        $image->file_name = $full_name;
                        $image->file_size = $file_size;
                        $image->person_id = $personID;
                        $image->save();
                    }
                }
            }

            //redirect on finish
            return Redirect::to('admin/osobe/pregled/'.$personID)->with(array('success' => 'Osoba je uspješno dodana.'));

        }
        else{
            return Redirect::to('admin/osobe/nova')->withErrors($error_list)->withInput();
        }
    }

    /**
     * @param null $id
     * @return mixed
     * find and show data for individual persons if exists
     */
    public function getPregled($id = null)
    {
        if ($id !== null){
            $personData = Person::find(e($id));

            //check if news exists
            if($personData){
                $this->layout->content = View::make('admin/osobe/pregled')->with(array('personData' => $personData));
            }
            else{
                return Redirect::to('admin/osobe')->withErrors('Osoba ne postoji.');
            }
        }
        else{
            return Redirect::to('admin/osobe')->withErrors('Osoba ne postoji.');
        }
    }

}