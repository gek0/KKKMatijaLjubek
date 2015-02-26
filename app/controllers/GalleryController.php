<?php

class GalleryController extends AdminController{

    /**
     *  gallery homepage, list all images from DB and form output for new images
     */
    public function getIndex()
    {
        $galleryData = Gallery::orderBy('id', 'DESC')->get();
        $this->layout->content = View::make('admin.naslovnica.index')->with('galleryData', $galleryData);
    }

    /**
     * @return mixed
     * post data for adding new images to  public homepage gallery
     */
    public function postIndex()
    {
        //get form data
        $gallery_images = Input::file('gallery_images');
        $error_list = null;

        /*
         *  validation
         */
        if($gallery_images == true){
            foreach($gallery_images as $img){
                $validator = Validator::make(array('images' => $img), Gallery::$rules, Gallery::$messages);
                if($validator->fails()){
                    $error_list = $validator->messages();
                }
            }
        }

        //store to database if no errors
        if($validator->fails()){
            return Redirect::to('admin/naslovnica')->withErrors($error_list)->withInput();
        }
        else{
            if($gallery_images == true && $gallery_images[0] != null){
                //check for image directory
                $path = public_path().'/gallery_uploads/';

                foreach($gallery_images as $img){
                    $file_name = Str::random(15);
                    $file_exstension = $img->getClientOriginalExtension();
                    $full_name = $file_name.'.'.$file_exstension;
                    $file_size = $img->getSize();

                    $file_uploaded = $img->move($path, $full_name);
                    if($file_uploaded){
                        $image = new Gallery;
                        $image->file_name = $full_name;
                        $image->file_size = $file_size;
                        $image->save();
                    }
                }
            }

            //redirect on finish
            return Redirect::to('admin/naslovnica')->with(array('success' => 'Slike su uspješno dodane.'));
        }
    }

    /**
     * @return mixed
     * AJAX image delete form gallery
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
                $image = Gallery::find($image_id);

                //delete image if exists and return JSON response
                if($image){
                    try{
                        $file_name = public_path().'/gallery_uploads/'.$image->file_name;
                        if(File::exists($file_name)){
                            File::delete($file_name);
                        }
                        $image->delete();

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