<?php

class UserController extends Controller {

    /**
     * instantiate a new UserController instance
     * authorization and csrf validation
     */
    public function __construct()
    {
        //$this->beforeFilter('auth', array('except' => 'getLogout'));
        $this->beforeFilter('csrf', array('on' => 'post'));
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

        return "Hello admin";
    }

}