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
            $intended_url = Session::get('url.intended', url('admin'));
            Session::forget('url.intended');

            return View::make('login.login')->with('intended_url', $intended_url);
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
            $input_data = Input::get('formData');
            $user_data = array(
                'username' => e($input_data['username']),
                'password' => $input_data['password'],
                'rememberMe' => e($input_data['rememberMe'])
            );

            $remember_me = false;
            if($user_data['rememberMe'] == '1'){
                $remember_me = true;
            }

            if (Auth::attempt(array('username' => $user_data['username'], 'password' => $user_data['password']), $remember_me)) {
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