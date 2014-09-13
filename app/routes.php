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
Route::pattern('slug', '[A-Za-z0-9_]+');
Route::pattern('bar_type', '[A-Za-z0-9]+');
Route::pattern('date_unit', '[A-Za-z0-9]+');
Route::pattern('selected_comparison', '[A-Za-z0-9]+');
Route::pattern('dt_start', '^([0-9]{4})-([0-9]{2})-([0-9]{2})$');
Route::pattern('dt_end', '^([0-9]{4})-([0-9]{2})-([0-9]{2})$');
Route::pattern('numeric', '[0-9]+');

Route::group(array('namespace' => 'App\Controllers'), function() {

    /**
     * HomeController
     */
    Route::get('/', 'HomeController@getHome');
    Route::get('home', 'HomeController@getHome');

    Route::get('login', 'HomeController@getLogin');
    Route::post('login/submit', 'HomeController@postLogin');

    Route::get('register', 'HomeController@getRegister');
    Route::post('register/submit', 'HomeController@postRegister');

//    Route::get('forgot', 'HomeController@getForgotPassword');
//    Route::post('forgot/submit', 'HomeController@postForgotPassword');
//
//    Route::get('reset/{token}', 'HomeController@getReset');
//    Route::post('reset/submit', 'HomeController@postReset');

    /**
     * List of categories
     * List of brands by category
     * 
     * CategoryController
     */
    Route::get('categories', 'CategoryController@index');
    Route::get('category/{slug}', 'CategoryController@getBrands');
    Route::get('category/{slug}/brands', 'CategoryController@getBrands');

    /**
     * List of brands
     * List of models by brand
     * 
     * 
     * BrandController
     */
    Route::get('brands', 'BrandController@index');
    Route::get('brand/{slug}', 'BrandController@getModels');
    Route::get('brand/{slug}/models', 'BrandController@getModels');

    /**
     * Specification of model
     * 
     * FeatureController
     */
    Route::get('model/{slug}/specs', 'FeatureController@getSpecs');


    /**
     * List of all listings
     * 
     * Detail of listing
     * Review of listing
     * 
     * PostController
     */
    Route::get('listing/{name}/detail', 'PostController@getDetail');
});


