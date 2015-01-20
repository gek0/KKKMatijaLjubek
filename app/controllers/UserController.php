<?php

class UserController extends BaseController {

    /**
     * instantiate a new UserController instance
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', array('on' => array('post', 'put', 'patch', 'delete')));
    }

    /**
     * @return mixed
     * logout from admin area
     */
    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/');
    }

    /**
     * @return string
     * login page for admin area
     */
    public function getLogin()
    {
        //check if user is logged in
        if(Auth::user()){
            return Redirect::to('admin');
        }
        else{
            return View::make('admin.login');
        }
    }

    /**
     * @return mixed
     * login validation for user
     */
    public function postLogin()
    {
        if(Auth::user()){
            return Redirect::to('admin');
        }

        $userdata = array(
            'username' => e(Input::get('username')),
            'password' => Input::get('password')
        );

        $isAuth = Auth::attempt($userdata);

        if($isAuth){
            return Redirect::to('admin');
        }
        else{
            return Redirect::to('admin/login/');
        }
    }

    /**
     * @return string
     * main page for admin area
     */
    public function getIndex()
    {
        if(Auth::guest()){
            return Redirect::to('admin/login/');
        }

        return View::make('admin.index');
    }

}