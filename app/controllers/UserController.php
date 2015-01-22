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
            $inputData = Input::get('formData');
            $token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
            $userData = array(
                'username' => $inputData['username'],
                'email' => $inputData['email'],
                'password' => $inputData['password'],
                'passwordAgain' => $inputData['passwordAgain'],
            );

            //validation
            $validator = Validator::make($userData, User::$rulesLessStrict, User::$messages);

            //check if csrf token is valid
            if(Session::token() != $token){
                //throw new Illuminate\Session\TokenMismatchException;
                return Response::json(array(
                    'status' => 'error',
                    'errors' => 'CSRF token is not valid'
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
                    $user->username = e($userData['username']);
                    $user->email = e($userData['email']);
                    //change user password if new is in input
                    if(strlen($userData['password']) > 0) {
                        $user->password = Hash::make($userData['password']);
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
                'errors' => 'Data not sent with Ajax'
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
            $inputData = Input::get('formData');
            $token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
            $userData = array(
                'username' => $inputData['newUsername'],
                'email' => $inputData['newEmail'],
                'password' => $inputData['newPassword'],
                'passwordAgain' => $inputData['newPasswordAgain'],
            );

            //validation
            $validator = Validator::make($userData, User::$rules, User::$messages);

            //check if csrf token is valid
            if(Session::token() != $token){
                //throw new Illuminate\Session\TokenMismatchException;
                return Response::json(array(
                    'status' => 'error',
                    'errors' => 'CSRF token is not valid'
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
                    $user->username = e($userData['username']);
                    $user->email = e($userData['email']);
                    $user->password = Hash::make($userData['password']);
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
                'errors' => 'Data not sent with Ajax'
            ));
        }
    }

}