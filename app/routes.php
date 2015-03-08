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
    Route::controller('admin/naslovnica', 'GalleryController');
    Route::controller('admin/vijesti', 'NewsController');
    Route::controller('admin/korisnik', 'UserController');
    Route::controller('admin/osobe', 'PersonController');
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
Route::get('rss', array('as' => 'rss', 'uses' => 'HomeController@getRssFeed'));
Route::get('tag/{id}', array('as' => 'tag', 'uses' => 'HomeController@tag'))->where(array('id' => '[0-9]+'));
Route::get('clan/{slug}', array('as' => 'clan', 'uses' => 'HomeController@showPerson'))->where(array('slug' => '[a-zA-Z\-]+'));
Route::get('vijesti/sort', array('as' => 'vijesti-sort', 'uses' => 'HomeController@getSort'));
Route::get('vijesti/{slug}', array('as' => 'vijest', 'uses' => 'HomeController@showNews'))->where(array('slug' => '[a-zA-Z\-]+'));
Route::get('vijesti', array('as' => 'vijesti', 'uses' => 'HomeController@showNewsList'));
Route::get('tagovi', array('as' => 'tagovi', 'uses' => 'HomeController@showTagsList'));
Route::controller('/', 'HomeController');