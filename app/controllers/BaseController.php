<?php

class BaseController extends Controller {

	/**
	 * CSRF validation on requests
	 */
	public function __construct()
	{
		$this->beforeFilter('crfs', array('on' => array('post', 'put', 'patch', 'delete')));
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

	protected $layout = "layouts.main";
	protected $header = "layouts.header";
	protected $footer = "layouts.footer";

	protected function setupLayout()
	{
		if (!is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
			$this->layout->header = View::make($this->header);
			$this->layout->footer = View::make($this->footer);
		}
	}

}
