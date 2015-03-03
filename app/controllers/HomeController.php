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


}
