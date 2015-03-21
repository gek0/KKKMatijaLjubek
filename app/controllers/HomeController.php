<?php

class HomeController extends Controller {

	/**
	 * instantiate a new HomeController instance
	 * CSRF validation on requests
	 */
	public function __construct()
	{
		$this->beforeFilter('crfs', array('on' => array('post', 'put', 'patch', 'delete')));
	}

    /**
     * @var int
     * news paginate option
     */
    protected $news_paginate = 6;
    protected $sort_data = array('added_desc' => 'Najnovije vijesti',
                                 'added_asc' => 'Najstarije vijesti',
                                 'visits_desc' => 'S najviše pregleda',
                                 'visits_asc' => 'S najmanje pregleda'
                            );

	/**
	 * @return mixed
	 * homepage
     */
	public function showIndex()
	{
        //get gallery images for cover slider
        $gallery_data = Gallery::orderBy('id', 'DESC')->get();
        $gallery_count = $gallery_data->count();

        //get people categories
        $person_categories = PersonCategory::orderBy('id')->get();

        //get all persons
        $persons_data = Person::orderBy('person_full_name', 'ASC')->get();

        //get last 2 news
        $news_data = News::orderBy('id', 'DESC')->take(2)->get();

        return View::make('public.index')->with(array('gallery_data' => $gallery_data,
                                                      'gallery_count' => $gallery_count,
                                                      'person_categories' => $person_categories,
                                                      'persons_data' => $persons_data,
                                                      'news_data' => $news_data
                                                     )
                                                );
	}

    /**
     * @param $slug
     * @return mixed
     * individual person view
     */
    public function showPerson($slug)
    {
        //find person and get data if exists
        $person_data = Person::findBySlug(e($slug));

        //check if person exists
        if($person_data){
            //find previous and next person after current
            $previous_person = $person_data->previousPerson();
            $next_person = $person_data->nextPerson();

            //check if there are persons before/after or not
            if($previous_person){
                $previous_person = array('slug' => $previous_person->slug, 'full_name' => $previous_person->person_full_name);
            }
            else{
                $previous_person = false;
            }

            if($next_person){
                $next_person = array('slug' => $next_person->slug, 'full_name' => $next_person->person_full_name);
            }
            else{
                $next_person = false;
            }

            return View::make('public.clan')->with(array('person_data' => $person_data,
                                                         'page_title' => $person_data->person_full_name,
                                                         'previous_person' => $previous_person,
                                                         'next_person' => $next_person
                                                        )
                                                  );
        }
        else{
            App::abort(404, 'Korisnik nije pronađen.');
        }
    }

    /**
     * @return mixed
     * tags collection view
     */
    public function showTagsList()
    {
        $tags_data = Tag::all();
        $page_title = 'Tagovi';

        return View::make('public.tagovi')->with(array('tags_data' => $tags_data,
                                                       'page_title' => $page_title
                                                      )
                                                );
    }

    /**
     * @param $tag_slug
     * @return mixed
     * news collection view - paginated by @news_paginate / news with selected tag slug
     */
    public function showNewsByTag($tag_slug)
    {
        $page_title = 'Vijesti';

        //check if tag exists
        $tag_data = Tag::findBySlug(e($tag_slug));

        if($tag_data){
            $news_data = DB::table('news')->select(DB::raw('news.*, (SELECT news_images.`file_name` FROM news_images
                                                                        WHERE news_images.news_id= news.id
                                                                        ORDER BY news_images.`id` ASC
                                                                        LIMIT 1) AS newsImage'))
                                            ->join('news_tag', 'news.id', '=', 'news_tag.news_id')
                                            ->where('news_tag.tag_id', '=', $tag_data->id)
                                            ->orderBy('news.id', 'DESC')
                                            ->paginate($this->news_paginate);

            return View::make('public.news_tags')->with(array('page_title' => $page_title,
                                                              'tag_data' => $tag_data,
                                                              'news_data' => $news_data
                                                            )
                                                        );
        }
        else{
            App::abort(404, 'Tag vijesti ne postoji.');
        }
    }

    /**
     * @return mixed
     * news collection view - paginated by @news_paginate
     */
    public function showNewsList()
    {
        $news_data = News::orderBy('id', 'DESC')->paginate($this->news_paginate);
        $page_title = 'Vijesti';

        //default form sort value
        $news_text_sort = null;
        $sort_category = null;
        $sort_data = $this->sort_data;

        return View::make('public.vijesti')->with(array('news_data' => $news_data,
                                                        'page_title' => $page_title,
                                                        'sort_data' => $sort_data,
                                                        'sort_category' => $sort_category,
                                                        'news_text_sort' => $news_text_sort
                                                    )
                                                );
    }

    /**
     * @param $slug
     * @return mixed
     * individual news view
     */
    public function showNews($slug)
    {
        //find news and get data if exists
        $news_data = News::findBySlug(e($slug));

        //check if news exists
        if($news_data){
            //increment number of news views
            $news_data->increment('num_visited');

            //find previous and next person after current
            $previous_news = $news_data->previousNews();
            $next_news = $news_data->nextNews();

            //check if there are persons before/after or not
            if($previous_news){
                $previous_news = array('slug' => $previous_news->slug, 'news_title' => $previous_news->news_title);
            }
            else{
                $previous_news = false;
            }

            if($next_news){
                $next_news = array('slug' => $next_news->slug, 'news_title' => $next_news->news_title);
            }
            else{
                $next_news = false;
            }

            return View::make('public.clanak')->with(array('news_data' => $news_data,
                    'page_title' => $news_data->news_title,
                    'previous_news' => $previous_news,
                    'next_news' => $next_news
                )
            );
        }
        else{
            App::abort(404, 'Članak nije pronađen.');
        }
    }

    /**
     * @return mixed
     * sort news by selected category and return to main view, list all news by @news_paginate per page
     */
    public function getSort()
    {
        $page_title = 'Vijesti';

        //get form data and set default sort options
        $news_text_sort = e(Input::get('news_text_sort'));
        $sort_category = e(Input::get('sort_option'));
        $sort_data = $this->sort_data;

        //check sort category selected in form and get data
        switch($sort_category){
            case 'added_desc':
                if($news_text_sort == '') {
                    $news_data = News::orderBy('id', 'DESC')->paginate($this->news_paginate);
                }
                else{
                    $news_data = News::where('news_body', 'LIKE', '%'.$news_text_sort.'%')->orderBy('id', 'DESC')->paginate($this->news_paginate);
                }
                break;
            case 'added_asc':
                if($news_text_sort == '') {
                    $news_data = News::orderBy('id', 'ASC')->paginate($this->news_paginate);
                }
                else{
                    $news_data = News::where('news_body', 'LIKE', '%'.$news_text_sort.'%')->orderBy('id', 'ASC')->paginate($this->news_paginate);
                }
                break;
            case 'visits_desc':
                if($news_text_sort == '') {
                    $news_data = News::orderBy('num_visited', 'DESC')->paginate($this->news_paginate);
                }
                else{
                    $news_data = News::where('news_body', 'LIKE', '%'.$news_text_sort.'%')->orderBy('num_visited', 'DESC')->paginate($this->news_paginate);
                }
                break;
            case 'visits_asc':
                if($news_text_sort == '') {
                    $news_data = News::orderBy('num_visited', 'ASC')->paginate($this->news_paginate);
                }
                else{
                    $news_data = News::where('news_body', 'LIKE', '%'.$news_text_sort.'%')->orderBy('num_visited', 'ASC')->paginate($this->news_paginate);
                }
                break;
            default:
                if($news_text_sort == '') {
                    $news_data = News::orderBy('id', 'DESC')->paginate($this->news_paginate);
                }
                else{
                    $news_data = News::where('news_body', 'LIKE', '%'.$news_text_sort.'%')->orderBy('id', 'DESC')->paginate($this->news_paginate);
                }
        }

        return View::make('public.vijesti')->with(array('news_data' => $news_data,
                                                        'page_title' => $page_title,
                                                        'sort_data' => $sort_data,
                                                        'sort_category' => $sort_category,
                                                        'news_text_sort' => $news_text_sort
                                                    )
                                                );
    }

    /**
     * @return mixed
     * cached news feed for 5 latest news on the site
     */
    public function getRssFeed()
    {
        //generate feed and cache for 60 min
        $feed = Feed::make();
        $feed->setCache(60, 'ljubekRssKey');

        //check if there is cached version
        if(!$feed->isCached()){
            //grab news data from database
            $news_data = News::orderBy('id', 'DESC')->take(5)->get();

            //set feed parameters
            $feed->title = 'KKK Matija Ljubek RSS';
            $feed->description = 'Najnovije vijesti na KKK Matija Ljubek portalu';
            $feed->logo = URL::to('css/assets/images/logo_main_log.png');
            $feed->link = URL::to('rss');
            $feed->setDateFormat('datetime');
            $feed->pubdate = $news_data[0]->created_at;
            $feed->lang = 'hr';
            $feed->setShortening(true);
            $feed->setTextLimit(500);

            foreach($news_data as $news){
                $feed->add($news->news_title, $news->author->username, URL::to('vijesti/'.$news->slug), $news->created_at, (new BBCParser)->unparse($news->news_body), '');
            }
        }

        return $feed->render('atom');
    }

    public function sendEmail()
    {
        if (Request::ajax()) {
            //define validator rules and messages
            $rules = array('full_name' => 'required|between:2,100',
                'email' => 'required|email',
                'message_body' => 'required|min:10',
                'g-recaptcha-response' => 'required|captcha'
            );

            $messages = array('full_name.required' => 'Zaboravili ste unjeti ime i prezime.',
                'full_name.between' => 'Ime i prezime ne mogu biti dulji od 100 znakova i kraći od 2.',
                'email.required' => 'E-mail adresa je obavezno polje.',
                'email.email' => 'Unjeta e-mail adresa nije važeća.',
                'message_body.required' => 'Poruka je obavezno polje.',
                'message_body.min' => 'Poruka je prekratka, minimalno 10 znakova.',
                'g-recaptcha-response.required' => 'Captcha je obavezna.',
                'g-recaptcha-response.captcha' => 'Captcha nije važeća.'
            );

            //get form data
            $input_data = Input::get('formData');
            $token = Input::get('_token');
            $user_data = array('full_name' => e($input_data['full_name']),
                               'email' => e($input_data['email']),
                               'message_body' => e($input_data['message']),
                               'g-recaptcha-response' => e($input_data['g-recaptcha-response'])
                         );

            //validate user data
            $validator = Validator::make($user_data, $rules, $messages);

            //check if csrf token is valid
            if(Session::token() != $token){
                return Response::json(array(
                    'status' => 'error',
                    'errors' => 'CSRF token is not valid.'
                ));
            }
            else {
                //check validation results and save user if ok
                if($validator->fails()){
                    return Response::json(array(
                        'status' => 'error',
                        'errors' => $validator->getMessageBag()->toArray()
                    ));
                }
                else{
                    //send email
                    try{
                        Mail::send('email', $user_data, function($message) use ($user_data){
                            $message->from($user_data['email'], $user_data['full_name']);
                            $message->to('kkkmatijaljubek@yahoo.com')->subject('KKK Matija Ljubek - nova poruka');
                        });

                        return Response::json(array(
                            'status' => 'success'
                        ));
                    }
                    catch(Exception $e){
                        return Response::json(array(
                            'status' => 'error',
                            'errors' => 'E-mail nije mogao biti poslan'
                        ));
                    }
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
