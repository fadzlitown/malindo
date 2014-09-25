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
Route::pattern('code', '[A-Za-z0-9]+');
Route::pattern('slug', '[A-Za-z0-9_]+');
Route::pattern('bar_type', '[A-Za-z0-9]+');
Route::pattern('date_unit', '[A-Za-z0-9]+');
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
    Route::get('categories', 'CategoriesController@index');
    Route::get('category/{slug}', 'CategoriesController@getBrands');
    Route::get('category/{slug}/brands', 'CategoriesController@getBrands');

    /**
     * List of brands
     * List of models by brand
     * 
     * 
     * BrandController
     */
    Route::get('brands', 'BrandsController@index');
    Route::get('brand/{slug}', 'BrandsController@getModels');
    Route::get('brand/{slug}/models', 'BrandsController@getModels');

    /**
     * Specification of model
     * 
     * FeatureController
     */
    Route::get('model/{slug}/specs', 'FeaturesController@getSpecs');


    /**
     * List of all listings
     * 
     * Detail of listing
     * Review of listing
     * 
     * PostController
     */
    Route::get('listing/{name}/detail', 'PostsController@getDetail');
});

Route::group(array('before' => 'auth', 'namespace' => 'App\Controllers\User'), function() {
    #Dashboard
    Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'PanelController@index'));

    #Update Profile
    Route::get('user/profile', 'UsersController@getProfile');
    Route::post('user/profile/submit', 'UsersController@postProfile');
    Route::get('user/profile', array('as' => 'profile', 'uses' => 'UsersController@getProfile'));

    #Update Password
    Route::get('user/password', 'UsersController@getPassword');
    Route::post('user/password/submit', 'UsersController@postPassword');
    Route::get('user/password', array('as' => 'password', 'uses' => 'UsersController@getPassword'));

    #Create new post listing (Detail and description)
    Route::get('listing/create', 'PostsController@getCreate');

    #Submit new post listing
    Route::post("listing/submit", "PostsController@submitCreate");
    #Update media of listing post
    #Update post listing detail and description
    Route::get('listing/{name}/edit', 'PostsController@getCreate');

    #after create detail and description, popup modal to ask them to upload the image together with Generic Number
    Route::get('listing/{code}/photo', 'PostsController@getMedia');
    Route::post('listing/photo/submit', 'PostsController@submitMedia');
});


Route::group(array('prefix' => 'api/v1', 'namespace' => 'App\Controllers\Api'), function() {
    Route::resource('todos', 'TodosController');
    Route::resource('auth', 'AuthController', array('only' => array('index')));
});
