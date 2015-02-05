<?php

class NewsController extends AdminController{

    /**
     * news homepage
     */
    public function getIndex()
    {
        $this->layout->content = View::make('admin.vijesti.index');
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
            if($news_images == true){
                //check for image directory
                $path = public_path().'/news_uploads/'.$newsID;
                if (!file_exists($path)){
                    mkdir($path, 0777);
                }

                foreach($news_images as $img){
                    $file_name = $newsName.'_'.Str::random(5);
                    $file_exstension = $img->getClientOriginalExtension();
                    $full_name = $file_name.'.'.$file_exstension;
                    $file_size = $img->getSize();

                    $file_uploaded = $img->move($path, $full_name);
                    if($file_uploaded){
                        $image = new NewsImage;
                        $image->file_name = $full_name;
                        $image->file_location = $path;
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
            if($newsData) {
                $this->layout->content = View::make('admin/vijesti/pregled')->with(array('newsData' => $newsData, 'found' => true));
            }
            else{
                return Redirect::to('admin/vijesti')->withErrors('Članak ne postoji.');
            }
        }
    }

}