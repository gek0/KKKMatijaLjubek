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
        $tag_collection = Tag::distinct()->select('tag')->get();    //get all tags for input suggestion
        $this->layout->content = View::make('admin.vijesti.nova')->with('tag_collection', $tag_collection);
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

        /*
         *  validation
         */
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
                if(!File::exists($path)){
                    File::makeDirectory($path, 0777);
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
            return Redirect::to('admin/vijesti/pregled/'.$newsID)->with(array('success' => 'Vijest je uspješno dodana.'));

        }
        else{
            return Redirect::to('admin/vijesti/nova')->withErrors($error_list)->withInput();
        }
    }

    /**
     * @param null $id
     * @return mixed
     * post data for news edit
     */
    public function postIzmjena($id = null)
    {
        if($id !== null){
            $news = News::find(e($id));

            if($news){
                //get form data
                $news_images = Input::file('news_images');
                $news_tags = Input::get('tags');
                $news_data = array('news_title' => e(Input::get('news_title')), 'news_body' => e(Input::get('news_body')));


                /*
                 *  tags
                */
                if($news_tags){ //remove same tags from array
                    $news_tags = array_unique($news_tags, SORT_STRING);
                }

                $old_tags = DB::table('tags')->leftJoin('news_tag', 'tags.id', '=', 'news_tag.tag_id')
                                                ->select('news_tag.tag_id', 'tags.tag')
                                                ->where('news_tag.news_id', '=', $news->id)
                                                ->get();

                //compare new tags from form and old ones from db
                if($old_tags){
                    if($news_tags){
                        foreach($old_tags as $tags){
                            //delete tags from db if removed in form
                            if(!in_array($tags->tag, $news_tags)){
                                $news->tags()->detach($tags->tag_id);
                                $tag = Tag::where('id', '=', $tags->tag_id)->delete();
                            }
                            else{
                                if(($key = array_search($tags->tag, $news_tags)) !== false) {
                                    unset($news_tags[$key]);    //duplicate tag - delete from new array if already in database
                                }
                            }
                        }
                    }
                    else{   //delete all tags from db
                        foreach($old_tags as $tags){
                            $news->tags()->detach($tags->tag_id);
                            $tag = Tag::where('id', '=', $tags->tag_id)->delete();
                        }
                    }
                }


                /*
                 *  validation
                 */
                $success = true;
                $error_list = null;

                $validator = Validator::make($news_data, News::$rulesLessStrict, News::$messages);
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

                if($news_tags == true){
                    foreach($news_tags as $tags){
                        $validator_tags = Validator::make(array('tag' => $tags), Tag::$rules, Tag::$messages);
                        if($validator_tags->fails()){
                            $error_list = $validator->messages()->merge($validator_tags->messages());
                            $success = false;
                        }
                    }
                }

                //store changes to database if no errors
                if($success == true){
                    $news->news_title = $news_data['news_title'];
                    $news->news_body = $news_data['news_body'];
                    $news->save();

                    $newsName = safe_name($news->news_title);

                    //add new tags if any
                    if($news_tags){
                        foreach($news_tags as $tags){
                            $tag = new Tag;
                            $tag->tag = e($tags);
                            $tag->save();
                            $news->tags()->attach($tag);
                        }
                    }

                    //add new images
                    if($news_images == true && $news_images[0] != null){
                        //check for image directory
                        $path = public_path().'/news_uploads/'.$news->id.'/';
                        if(!File::exists($path)){
                            File::makeDirectory($path, 0777);
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
                                $image->news_id = $news->id;
                                $image->save();
                            }
                        }
                    }


                    //redirect on finish
                    return Redirect::to('admin/vijesti/pregled/'.$news->id)->with(array('success' => 'Vijest je uspješno izmjenjena.'));
                }
                else{
                    return Redirect::back()->withErrors($error_list)->withInput();
                }
            }
            else{
                return Redirect::to('admin/vijesti')->withErrors('Vijest ne postoji.');
            }
        }
        else{
            return Redirect::to('admin/vijesti')->withErrors('Vijest ne postoji.');
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
                $this->layout->content = View::make('admin/vijesti/pregled')->with(array('newsData' => $newsData));
            }
            else{
                return Redirect::to('admin/vijesti')->withErrors('Vijest ne postoji.');
            }
        }
        else{
            return Redirect::to('admin/vijesti')->withErrors('Vijest ne postoji.');
        }
    }

    /**
     * @param null $id
     * @return mixed
     * find and get data for individuals news to populate edit form
     */
    public function getIzmjena($id = null){
        if($id !== null){
            $newsData = News::find(e($id));

            //check if news exists
            if($newsData){
                //check if news has tags
                $tags = array();
                if($newsData->tags){
                    foreach($newsData->tags as $tag){
                        $tags[] = $tag->tag;
                    }
                    $tags = json_encode($tags);
                }

                $tag_collection = Tag::distinct()->select('tag')->get();    //get all tags for input suggestion
                $this->layout->content = View::make('admin/vijesti/izmjena')->with(array('newsData' => $newsData, 'newsTags' => $tags, 'tag_collection' => $tag_collection));
            }
            else{
                return Redirect::to('admin/vijesti')->withErrors('Vijest ne postoji.');
            }
        }
        else{
            return Redirect::to('admin/vijesti')->withErrors('Vijest ne postoji.');
        }
    }

    /**
     * @param null $id
     * @return mixed
     * find and delete news data if it exists
     */
    public function getBrisanje($id = null)
    {
        if($id !== null){
            $news = News::find(e($id));

            //check if news exists
            if($news){
                try{
                    //delete data from database
                    $news->delete();
                    //delete images from disk
                    File::deleteDirectory(public_path() . '/news_uploads/' . $id . '/');

                    return Redirect::to('admin/vijesti')->with(array('success' => 'Vijest je uspješno obrisana.'));
                }
                catch(Exception $e){
                    return Redirect::to('admin/vijesti/pregled/'.$id)->withErrors('Vijest nije mogla biti obrisana.');
                }
            }
            else{
                return Redirect::to('admin/vijesti')->withErrors('Vijest ne postoji.');
            }
        }
        else{
            return Redirect::to('admin/vijesti')->withErrors('Vijest ne postoji.');
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
                    'errors' => 'CSRF token is not valid.'
                 ));
            }
            else{
                $newsImage = NewsImage::find($image_id);
                $newsID = $newsImage->news_id;

                //delete image if exists and return JSON response
                if($newsImage){
                    try{
                        $file_name = public_path().'/news_uploads/'.$newsID.'/'.$newsImage->file_name;
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
                'errors' => 'Data not sent with Ajax.'
            ));
        }
    }

}