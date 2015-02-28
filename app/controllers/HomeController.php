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
        $galleryData = Gallery::orderBy('id', 'DESC')->get();
        $galleryCount = $galleryData->count();
        return View::make('public.index')->with(array('galleryData' => $galleryData,
                                                      'galleryCount' => $galleryCount)
                                                );
	}


}
