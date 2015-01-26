<?php

class AdminController extends Controller {

    /**
     * instantiate a new AdminController instance
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

    protected $layout = "adminLayouts.main";
    protected $header = "adminLayouts.header";
    protected $footer = "adminLayouts.footer";

    protected function setupLayout()
    {
        if (!is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
            $this->layout->header = View::make($this->header);
            $this->layout->footer = View::make($this->footer);
        }
    }

    /**
     * @return string
     * main page for admin area
     */
    public function getIndex()
    {
        if(Auth::guest()){
            return Redirect::to('login');
        }

        $this->layout->content = View::make('admin.index');
    }

}