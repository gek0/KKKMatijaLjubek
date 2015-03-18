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
        $gallery_image = Input::file('gallery_image');
        $gallery_data = array('caption' => e(Input::get('caption')));
        $success = true;
        $error_list = null;

        /*
         *  validation
         */
        $validator = Validator::make($gallery_data, Gallery::$rules, Gallery::$messages);
        if($validator->fails()){
            $error_list = $validator->messages();
            $success = false;
        }

        $validator_images = Validator::make(array('image' => $gallery_image), Gallery::$rules, Gallery::$messages);
        if($validator_images->fails()){
            $error_list = $validator->messages()->merge($validator_images->messages());
            $success = false;
        }

        //store to database if no errors
        if($success == true){
            $path = public_path().'/gallery_uploads/';

            $file_name = 'gallery-cover-'.Str::random(10);
            $file_extension = $gallery_image->getClientOriginalExtension();
            $full_name = $file_name.'.'.$file_extension;
            $file_size = $gallery_image->getSize();

            $file_uploaded = $gallery_image->move($path, $full_name);

            //resize image
            $img_resizer = Image::make($path.$full_name);
            $img_resizer->resize(1280, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img_resizer->save();

            if($file_uploaded){
                $image = new Gallery;
                $image->file_name = $full_name;
                $image->file_size = $file_size;
                $image->caption = $gallery_data['caption'];
                $image->save();
            }

            //redirect on finish
            return Redirect::to('admin/naslovnica')->with(array('success' => 'Slika je uspješno dodana.'));
        }
        else{
            return Redirect::to('admin/naslovnica')->withErrors($error_list)->withInput();
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

    /**
     * @return mixed
     * AJAX image caption edit in gallery
     */
    public function postGalleryImageEdit()
    {
        if(Request::ajax()){

            //get image data and token
            $image_id = e(Input::get('imageID'));
            $imageData = array('caption' => e(Input::get('imageCaption')));
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

                //edit image caption if exists and return JSON response
                if($image){
                    try{
                        $image->caption = $imageData['caption'];
                        $image->save();

                        return Response::json(array(
                            'status' => 'success'
                        ));
                    }
                    catch(Exception $e){
                        return Response::json(array(
                            'status' => 'error',
                            'errors' => 'Izmjena teksta slike nije uspjela.'
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