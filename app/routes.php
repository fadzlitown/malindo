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

/*
  |--------------------------------------------------------------------------
  | Routes Pattern
  |--------------------------------------------------------------------------
 */
Route::pattern('token', '[A-Za-z0-9]+');
Route::pattern('type', '[A-Za-z0-9_]+');
Route::pattern('bar_type', '[A-Za-z0-9]+');
Route::pattern('date_unit', '[A-Za-z0-9]+');
Route::pattern('selected_comparison', '[A-Za-z0-9]+');
Route::pattern('dt_start', '^([0-9]{4})-([0-9]{2})-([0-9]{2})$');
Route::pattern('dt_end', '^([0-9]{4})-([0-9]{2})-([0-9]{2})$');
Route::pattern('numeric', '[0-9]+');

Route::group(array('namespace' => 'App\Controllers'), function() {
    Route::get('/', 'HomeController@getHome');
    Route::get('home', 'HomeController@getHome');

    Route::get('login', 'HomeController@getLogin');
    Route::post('login/submit', 'HomeController@postLogin');

    Route::get('register', 'HomeController@getRegister');
    Route::post('register/submit', 'HomeController@postRegister');

    Route::get('forgot', 'HomeController@getForgotPassword');
    Route::post('forgot/submit', 'HomeController@postForgotPassword');

    Route::get('reset/{token}', 'HomeController@getReset');
    Route::post('reset/submit', 'HomeController@postReset');
});

