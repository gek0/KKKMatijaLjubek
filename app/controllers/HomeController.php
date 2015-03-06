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
     * news collection view - paginated by 6 / 3 rows
     */
    public function showNewsList()
    {
        $newsData = News::orderBy('id', 'DESC')->paginate(6);
        $page_title = 'Vijesti';

        return View::make('public.vijesti')->with(array('newsData' => $newsData,
                                                        'page_title' => $page_title
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

}
