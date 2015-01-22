<?php

class HomeController extends BaseController {

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
		$this->layout->header = View::make($this->header, array('pageTitle' => 'Početna'));
		$this->layout->content = View::make('public.index');
	}


}
