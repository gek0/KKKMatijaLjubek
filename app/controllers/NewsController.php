<?php

class NewsController extends AdminController{

    /**
     *  news admin homepage, list all news by 9 per page / 3 rows
     */
    public function getIndex()
    {
        $newsData = News::paginate(9);
        $this->layout->content = View::make('admin.vijesti.index')->with('newsData', $newsData);
    }

    /**
     * new news form output
     */
    public function getNova()
    {
        $this->layout->content = View::make('admin.vijesti.nova');
    }

    /**
     * @return mixed
     * post data for adding new news
     */
    public function postNova()
    {
        //get form data
        $news_images = Input::file('news_images');
        $news_tags = Input::get('tags');
        $news_data = array('news_title' => e(Input::get('news_title')), 'news_body' => e(Input::get('news_body')));
        $success = true;
        $error_list = null;

        //remove duplicate tags if any
        if($news_tags == true){
            $news_tags_unique = array_unique($news_tags, SORT_STRING);
        }
        else{
            $news_tags_unique = false;
        }

        //validation
        $validator = Validator::make($news_data, News::$rules, News::$messages);
        if($validator->fails()){
            $error_list = $validator->messages();
            $success = false;
        }

        if($news_images == true){
            foreach($news_images as $img){
                $validator_images = Validator::make(array('images' => $img), NewsImage::$rules, NewsImage::$messages);
                if($validator_images->fails()){
                    $error_list = $validator->messages()->merge($validator_images->messages());
                    $success = false;
                }
            }
        }

        if($news_tags_unique == true){
            foreach($news_tags_unique as $tags){
                $validator_tags = Validator::make(array('tag' => $tags), Tag::$rules, Tag::$messages);
                if($validator_tags->fails()){
                    $error_list = $validator->messages()->merge($validator_tags->messages());
                    $success = false;
                }
            }
        }

        //store to database if no errors
        if($success == true){
            $news = new News;
            $news->news_title = $news_data['news_title'];
            $news->news_body = $news_data['news_body'];
            $news->news_author = Auth::user()->id;
            $news->save();

            $newsID = $news->id;
            $newsName = safe_name($news->news_title);

           //tags
           if($news_tags_unique == true){
                foreach($news_tags_unique as $tags){
                    $tag = new Tag;
                    $tag->tag = e($tags);
                    $news->tags()->save($tag);
                }
           }

            //images
            if($news_images == true && $news_images[0] != null){
                //check for image directory
                $path = public_path().'/news_uploads/'.$newsID.'/';
                if (!file_exists($path)){
                    mkdir($path, 0777);
                }

                foreach($news_images as $img){
                    $file_name = substr($newsName, 0, 15).'_'.Str::random(5);
                    $file_exstension = $img->getClientOriginalExtension();
                    $full_name = $file_name.'.'.$file_exstension;
                    $file_size = $img->getSize();

                    $file_uploaded = $img->move($path, $full_name);
                    if($file_uploaded){
                        $image = new NewsImage;
                        $image->file_name = $full_name;
                        $image->file_size = $file_size;
                        $image->news_id = $newsID;
                        $image->save();
                    }
                }
            }

            //redirect on finish
            return Redirect::to('admin/vijesti/pregled/'.$newsID)->with(array('success' => 'Članak je uspješno dodan.'));

        }
        else{
            return Redirect::to('admin/vijesti/nova')->withErrors($error_list)->withInput();
        }
    }

    /**
     * @param null $id
     * @return mixed
     * find and show data for individual news if exists
     */
    public function getPregled($id = null)
    {
        if ($id !== null){
            $newsData = News::find(e($id));

            //check if news exists
            if($newsData){
                $this->layout->content = View::make('admin/vijesti/pregled')->with(array('newsData' => $newsData, 'found' => true));
            }
            else{
                return Redirect::to('admin/vijesti')->withErrors('Članak ne postoji.');
            }
        }
    }

    /**
     * @param $tagQuery
     * @return mixed
     * return list of tags as JSON (used it in autocomplete forms)
     */
    public function getDohvatitagove($tagQuery)
    {
        $tagData = array();
        $tagQuery = e($tagQuery); //sanitize input

        //fetch tags by name
        $results = Tag::select('tag')->where('tag', 'LIKE', $tagQuery.'%')->take(10)->get();
        foreach($results as $result){
            $tagData[] = $result->tag;
        }

        return Response::json($tagData);
    }

    /**
     * @return mixed
     * AJAX image delete form news gallery
     */
    public function postGalleryimagedelete()
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
                    'errors' => 'CSRF token is not valid'
                 ));
            }
            else{
                $newsImage = NewsImage::find($image_id);

                //delete image if exists and return JSON response
                if($newsImage){
                    try{
                        $file_name = public_path().$newsImage->file_location.$newsImage->file_name;
                        if(File::exists($file_name)){
                            File::delete($file_name);
                        }
                        $newsImage->delete();

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
                'errors' => 'Data not sent with Ajax'
            ));
        }
    }

}