<?php

class UserController extends AdminController{

    /**
     * output for user settings route
     */
    public function getPostavke()
    {
        $this->layout->content = View::make('admin.korisnik.postavke');
    }

    /**
     * @return mixed
     * post Ajax data for changing current user settings
     */
    public function postPostavke()
    {
        if (Request::ajax()){

            //get user input data
            $input_data = Input::get('formData');
            $token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
            $user_data = array(
                'username' => $input_data['username'],
                'email' => $input_data['email'],
                'password' => $input_data['password'],
                'passwordAgain' => $input_data['passwordAgain'],
            );

            //validation
            $validator = Validator::make($user_data, User::$rulesLessStrict, User::$messages);

            //check if csrf token is valid
            if(Session::token() != $token){
                //throw new Illuminate\Session\TokenMismatchException;
                return Response::json(array(
                    'status' => 'error',
                    'errors' => 'CSRF token is not valid.'
                ));
            }
            else{
                //check validation results and save user if ok
                if($validator->fails()){
                    return Response::json(array(
                        'status' => 'error',
                        'errors' => $validator->getMessageBag()->toArray()
                    ));
                }
                else{
                    $user = User::find(Auth::user()->id);
                    $user->username = e($user_data['username']);
                    $user->email = e($user_data['email']);
                    //change user password if new is in input
                    if(strlen($user_data['password']) > 0) {
                        $user->password = Hash::make($user_data['password']);
                    }
                    $user->save();

                    return Response::json(array(
                        'status' => 'success'
                    ));
                }
            }
        }
        else{
            return Response::json(array(
                'status' => 'error',
                'errors' => 'Data not sent with Ajax.'
            ));
        }
    }

    /**
     * @return mixed
     * post Ajax data for adding new user
     */
    public function postNovi()
    {
        if (Request::ajax()){

            //get user input data
            $input_data = Input::get('formData');
            $token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
            $user_data = array(
                'username' => $input_data['newUsername'],
                'email' => $input_data['newEmail'],
                'password' => $input_data['newPassword'],
                'passwordAgain' => $input_data['newPasswordAgain'],
            );

            //validation
            $validator = Validator::make($user_data, User::$rules, User::$messages);

            //check if csrf token is valid
            if(Session::token() != $token){
                //throw new Illuminate\Session\TokenMismatchException;
                return Response::json(array(
                    'status' => 'error',
                    'errors' => 'CSRF token is not valid.'
                ));
            }
            else{
                //check validation results and save user if ok
                if($validator->fails()){
                    return Response::json(array(
                        'status' => 'error',
                        'errors' => $validator->getMessageBag()->toArray()
                    ));
                }
                else{
                    $user = new User;
                    $user->username = e($user_data['username']);
                    $user->email = e($user_data['email']);
                    $user->password = Hash::make($user_data['password']);
                    $user->save();

                    return Response::json(array(
                        'status' => 'success'
                    ));
                }
            }
        }
        else{
            return Response::json(array(
                'status' => 'error',
                'errors' => 'Data not sent with Ajax.'
            ));
        }
    }

}