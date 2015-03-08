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
	public function getIndex()
	{
        //get gallery images for cover slider
        $galleryData = Gallery::orderBy('id', 'DESC')->get();
        $galleryCount = $galleryData->count();

        //get people categories
        $person_categories = PersonCategory::orderBy('id')->get();

        //get all persons
        $personsData = Person::orderBy('person_full_name', 'ASC')->get();

        //get last 2 news
        $newsData = News::orderBy('id', 'DESC')->take(2)->get();

        return View::make('public.index')->with(array('galleryData' => $galleryData,
                                                      'galleryCount' => $galleryCount,
                                                      'person_categories' => $person_categories,
                                                      'personsData' => $personsData,
                                                      'newsData' => $newsData
                                                     )
                                                );
	}

    public function tag($id)
    {
        return View::make('public.tag');
    }

    /**
     * @param $slug
     * @return mixed
     * individual person view
     */
    public function showPerson($slug)
    {
        //find person and get data if exists
        $personData = Person::findBySlug(e($slug));

        //check if person exists
        if($personData){
            //find previous and next person after current
            $previousPerson = $personData->previousPerson();
            $nextPerson = $personData->nextPerson();

            //check if there are persons before/after or not
            if($previousPerson){
                $previousPerson = array('slug' => $previousPerson->slug, 'full_name' => $previousPerson->person_full_name);
            }
            else{
                $previousPerson = false;
            }

            if($nextPerson){
                $nextPerson = array('slug' => $nextPerson->slug, 'full_name' => $nextPerson->person_full_name);
            }
            else{
                $nextPerson = false;
            }

            return View::make('public.clan')->with(array('personData' => $personData,
                                                         'page_title' => $personData->person_full_name,
                                                         'previousPerson' => $previousPerson,
                                                         'nextPerson' => $nextPerson
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
        $tagsData = Tag::all();
        $page_title = 'Tagovi';

        return View::make('public.tagovi')->with(array('tagsData' => $tagsData,
                                                       'page_title' => $page_title
                                                      )
                                                );
    }

    /**
     * @return mixed
     * news collection view - paginated by @news_paginate
     */
    public function showNewsList()
    {
        $newsData = News::orderBy('id', 'DESC')->paginate($this->news_paginate);
        $page_title = 'Vijesti';

        //default form sort value
        $sort_category = null;
        $sort_data = $this->sort_data;

        return View::make('public.vijesti')->with(array('newsData' => $newsData,
                                                        'page_title' => $page_title,
                                                        'sort_data' => $sort_data,
                                                        'sort_category' => $sort_category
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
        $newsData = News::findBySlug(e($slug));

        //check if news exists
        if($newsData){
            //increment number of news views
            $newsData->increment('num_visited');

            //find previous and next person after current
            $previousNews = $newsData->previousNews();
            $nextNews = $newsData->nextNews();

            //check if there are persons before/after or not
            if($previousNews){
                $previousNews = array('slug' => $previousNews->slug, 'news_title' => $previousNews->news_title);
            }
            else{
                $previousNews = false;
            }

            if($nextNews){
                $nextNews = array('slug' => $nextNews->slug, 'news_title' => $nextNews->news_title);
            }
            else{
                $nextNews = false;
            }

            return View::make('public.clanak')->with(array('newsData' => $newsData,
                    'page_title' => $newsData->news_title,
                    'previousNews' => $previousNews,
                    'nextNews' => $nextNews
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
        $sort_category = e(Input::get('sort_option'));
        $sort_data = $this->sort_data;

        //check sort category selected in form and get data
        switch($sort_category){
            case 'added_desc':
                $newsData = News::orderBy('id', 'DESC')->paginate($this->news_paginate);
                break;
            case 'added_asc':
                $newsData = News::orderBy('id', 'ASC')->paginate($this->news_paginate);
                break;
            case 'visits_desc':
                $newsData = News::orderBy('num_visited', 'DESC')->paginate($this->news_paginate);
                break;
            case 'visits_asc':
                $newsData = News::orderBy('num_visited', 'ASC')->paginate($this->news_paginate);
                break;
            default:
                $newsData = News::orderBy('id', 'DESC')->paginate($this->news_paginate);
        }

        return View::make('public.vijesti')->with(array('newsData' => $newsData,
                                                        'page_title' => $page_title,
                                                        'sort_data' => $sort_data,
                                                        'sort_category' => $sort_category
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
            $newsData = News::orderBy('id', 'DESC')->take(5)->get();

            //set feed parameters
            $feed->title = 'KKK Matija Ljubek RSS';
            $feed->description = 'Najnovije vijesti na KKK Matija Ljubek portalu';
            $feed->logo = URL::to('css/assets/images/logo_main_log.png');
            $feed->link = URL::to('rss');
            $feed->setDateFormat('datetime');
            $feed->pubdate = $newsData[0]->created_at;
            $feed->lang = 'hr';
            $feed->setShortening(true);
            $feed->setTextLimit(500);

            foreach($newsData as $news){
                $feed->add($news->news_title, $news->author->username, URL::to('vijesti/'.$news->slug), $news->created_at, (new BBCParser)->unparse($news->news_body), '');
            }
        }

        return $feed->render('atom');
    }

}
