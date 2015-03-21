<?php

class PersonController extends AdminController{

    /**
     *  persons admin homepage - athletes and coaches, list all persons by 6 per page / 2 rows
     */
    public function getIndex()
    {
        $persons_data = Person::paginate(6);
        //get all categories from DB to populate dropdown
        $person_categories = PersonCategory::orderBy('id')->lists('category_name', 'id');
        $category_id = null; //default value

        $this->layout->content = View::make('admin.osobe.index', compact('person_categories'))->with(array('persons_data' => $persons_data, 'category_id' => $category_id));
    }

    /**
     *  sort persons by selected category and return to main view, list all persons by 6 per page / 2 rows
     */
    public function getCategorySort()
    {
        $category_id = e(Input::get('category'));

        $persons_data = Person::where('category_id', '=', $category_id)->paginate(6);

        //get all categories from DB to populate dropdown
        $person_categories = PersonCategory::orderBy('id')->lists('category_name', 'id');

        //category validation
        $category_data = array('person_category' => $category_id);
        $validator = Validator::make($category_data, Person::$rulesCategorySort, Person::$messages);
        if($validator->fails()){
            $error = $validator->messages();
            $this->layout->content = View::make('admin.osobe.index', compact('person_categories'))->with(array('persons_data' => $persons_data, 'category_id' => $category_id))->withErrors($error);
        }
        else{
            $this->layout->content = View::make('admin.osobe.index', compact('person_categories'))->with(array('persons_data' => $persons_data, 'category_id' => $category_id));
        }
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
            $person->person_birthday = $birthday_date->format('Y-m-d');
            $person->category_id = $person_data['person_category'];
            $person->is_athlete = $is_athlete;
            $person->save();

            $person_name = safe_name($person->person_full_name);

            //images
            if($person_images == true && $person_images[0] != null){
                //check for image directory
                $path = public_path().'/person_uploads/'.$person->id.'/';
                if(!File::exists($path)){
                    File::makeDirectory($path, 0777);
                }

                foreach($person_images as $img){
                    $file_name = $person_name.'_'.Str::random(5);
                    $file_extension = $img->getClientOriginalExtension();
                    $full_name = $file_name.'.'.$file_extension;
                    $file_size = $img->getSize();

                    $file_uploaded = $img->move($path, $full_name);

                    //resize image
                    $img_resizer = Image::make($path.$full_name);
                    $img_resizer->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $img_resizer->save();

                    if($file_uploaded){
                        $image = new PersonImage;
                        $image->file_name = $full_name;
                        $image->file_size = $file_size;
                        $image->person_id = $person->id;
                        $image->save();
                    }
                }
            }

            //redirect on finish
            return Redirect::to('admin/osobe/pregled/'.$person->slug)->with(array('success' => 'Osoba je uspješno dodana.'));

        }
        else{
            return Redirect::to('admin/osobe/nova')->withErrors($error_list)->withInput();
        }
    }


    /**
     * @param null $slug
     * @return mixed
     * post data for person edit
     */
    public function postIzmjena($slug = null)
    {
        if($slug !== null){
            $person = Person::findBySlug(e($slug));

            if($person){
                //get form data
                $person_images = Input::file('person_images');
                $person_data = array('person_full_name' => e(Input::get('person_full_name')),
                                     'person_description' => e(Input::get('person_description')),
                                     'person_category' => e(Input::get('person_category')),
                                     'person_birthday' => e(Input::get('person_birthday'))
                                );

                $is_athlete = ($person_data['person_category'] == 7 ? 'no' : 'yes');

                /*
                 *  validation
                 */
                $success = true;
                $error_list = null;

                $validator = Validator::make($person_data, Person::$rulesLessStrict, Person::$messages);
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

                //store changes to database if no errors
                if($success == true){
                    //convert input date to timestamp format
                    $birthday_date = new DateTime($person_data['person_birthday']);

                    $person->person_full_name = $person_data['person_full_name'];
                    $person->person_description = $person_data['person_description'];
                    $person->person_birthday = $birthday_date->format('Y-m-d');
                    $person->category_id = $person_data['person_category'];
                    $person->is_athlete = $is_athlete;
                    $person->save();

                    $personName = safe_name($person->person_full_name);

                    //add new images
                    if($person_images == true && $person_images[0] != null){
                        //check for image directory
                        $path = public_path().'/person_uploads/'.$person->id.'/';
                        if(!File::exists($path)){
                            File::makeDirectory($path, 0777);
                        }

                        foreach($person_images as $img){
                            $file_name = $personName.'_'.Str::random(5);
                            $file_extension = $img->getClientOriginalExtension();
                            $full_name = $file_name.'.'.$file_extension;
                            $file_size = $img->getSize();

                            $file_uploaded = $img->move($path, $full_name);

                            //resize image
                            $img_resizer = Image::make($path.$full_name);
                            $img_resizer->resize(1000, null, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                            $img_resizer->save();

                            if($file_uploaded){
                                $image = new PersonImage;
                                $image->file_name = $full_name;
                                $image->file_size = $file_size;
                                $image->person_id = $person->id;
                                $image->save();
                            }
                        }
                    }


                    //redirect on finish
                    return Redirect::to('admin/osobe/pregled/'.$person->slug)->with(array('success' => 'Osoba je uspješno izmjenjena.'));
                }
                else{
                    return Redirect::back()->withErrors($error_list)->withInput();
                }
            }
            else{
                return Redirect::to('admin/osobe')->withErrors('Osoba ne postoji.');
            }
        }
        else{
            return Redirect::to('admin/osobe')->withErrors('Osoba ne postoji.');
        }
    }

    /**
     * @param null $slug
     * @return mixed
     * find and show data for individual persons if exists
     */
    public function getPregled($slug = null)
    {
        if ($slug !== null){
            $person_data = Person::findBySlug(e($slug));

            //check if news exists
            if($person_data){
                $this->layout->content = View::make('admin/osobe/pregled')->with(array('person_data' => $person_data));
            }
            else{
                return Redirect::to('admin/osobe')->withErrors('Osoba ne postoji.');
            }
        }
        else{
            return Redirect::to('admin/osobe')->withErrors('Osoba ne postoji.');
        }
    }

    /**
     * @param null $slug
     * @return mixed
     * find and get data for individuals person to populate edit form
     */
    public function getIzmjena($slug = null){
        if($slug !== null){
            $person_data = Person::findBySlug(e($slug));

            //check if person exists
            if($person_data){
                //get all categories from DB to populate dropdown
                $person_categories = PersonCategory::orderBy('id')->lists('category_name', 'id');
                $this->layout->content = View::make('admin/osobe/izmjena')->with(array('person_data' => $person_data, 'person_categories' => $person_categories));
            }
            else{
                return Redirect::to('admin/osobe')->withErrors('Osoba ne postoji.');
            }
        }
        else{
            return Redirect::to('admin/osobe')->withErrors('Osoba ne postoji.');
        }
    }

    /**
     * @param null $slug
     * @return mixed
     * find and delete person data if it exists
     */
    public function getBrisanje($slug = null)
    {
        if($slug !== null){
            $person = Person::findBySlug(e($slug));

            //check if person exists
            if($person){
                try{
                    //delete images from disk
                    File::deleteDirectory(public_path().'/person_uploads/'.$person->id.'/');
                    //delete data from database
                    $person->delete();

                    return Redirect::to('admin/osobe')->with(array('success' => 'Osoba je uspješno obrisana.'));
                }
                catch(Exception $e){
                    return Redirect::to('admin/osobe/pregled/'.$slug)->withErrors('Osoba nije mogla biti obrisana.');
                }
            }
            else{
                return Redirect::to('admin/osobe')->withErrors('Osoba ne postoji.');
            }
        }
        else{
            return Redirect::to('admin/osobe')->withErrors('Osoba ne postoji.');
        }
    }

    /**
     * @return mixed
     * AJAX image delete form person gallery
     */
    public function postGalleryImageDelete()
    {
        if(Request::ajax()){

            //get image ID and token
            $image_id = e(Input::get('imageData'));
            $token = Request::header('X-CSRF-Token');

            //check if csrf token is valid
            if(Session::token() != $token){
                //throw new Illuminate\Session\TokenMismatchException;
                return Response::json(array(
                    'status' => 'error',
                    'errors' => 'CSRF token is not valid.'
                ));
            }
            else{
                $person_image = PersonImage::find($image_id);
                $person_id = $person_image->person_id;

                //delete image if exists and return JSON response
                if($person_image){
                    try{
                        $file_name = public_path().'/person_uploads/'.$person_id.'/'.$person_image->file_name;
                        if(File::exists($file_name)){
                            File::delete($file_name);
                        }
                        $person_image->delete();

                        return Response::json(array(
                            'status' => 'success'
                        ));
                    }
                    catch(Exception $e){
                        return Response::json(array(
                            'status' => 'error',
                            'errors' => 'Brisanje slike nije uspjelo.'
                        ));
                    }
                }
                else{
                    return Response::json(array(
                        'status' => 'error',
                        'errors' => 'Slika ne postoji.'
                    ));
                }
            }
        }
        else{
            return Response::json(array(
                'status' => 'error',
                'errors' => 'Data not sent with Ajax.'
            ));
        }
    }

}