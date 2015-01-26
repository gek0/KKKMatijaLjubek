<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * login to admin area
 */
Route::controller('login', 'LoginController');

/**
 * admin area
 */
Route::group(array('before' => 'auth'), function() {
    Route::controller('admin/korisnik', 'UserController');
    Route::controller('admin/vijesti', 'NewsController');
    Route::controller('admin', 'AdminController');
});

/**
 * logout from admin area
 */
Route::get('logout', function(){
    Auth::logout();
    return Redirect::to('/');
});

/**
 * public area
 */
Route::controller('/', 'HomeController');