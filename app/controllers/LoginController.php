<?php

class LoginController extends Controller{

    /**
     * instantiate a new LoginController instance
     * CSRF validation on requests
     */
    public function __construct(){
        $this->beforeFilter('crfs', array('on' => array('post', 'put', 'patch', 'delete')));
    }

    /**
     * @return mixed
     * login landing page
     */
    public function getIndex()
    {
        if(Auth::guest()){
            $intendedUrl = Session::get('url.intended', url('admin'));
            Session::forget('url.intended');

            return View::make('login.login')->with('intendedUrl', $intendedUrl);
        }
        else{
            return Redirect::to('admin');
        }
    }

    /**
     * @return mixed
     * login validation for user
     */
    public function postIndex()
    {
        if(Auth::user()){
            return Redirect::to('admin');
        }

        if (Request::ajax()) {
            $inputData = Input::get('formData');
            $userdata = array(
                'username' => e($inputData['username']),
                'password' => $inputData['password']
            );

            if (Auth::attempt($userdata)) {
                return Response::json(array(
                    'status' => 'success'
                ));
            } else {
                return Response::json(array(
                    'status' => 'error',
                    'errors' => 'Neispravno korisničko ime ili lozinka!'
                ));
            }
        }
        else{
            return Response::json(array(
                'status' => 'error',
                'errors' => 'Data not sent with Ajax'
            ));
        }
    }

}