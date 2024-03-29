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
Route::pattern('slug', '[A-Za-z0-9_-]+');
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
    Route::get('model/{id}/specs', 'FeaturesController@getSpecs');

    /**
     * List of all listings
     */
    Route::get('model/{slug}/listings', 'FeaturesController@getListings');

    /**
     * Detail of listing
     * Review of listing
     * 
     * PostController
     */
    Route::get('listing/{slug}/detail', 'PostsController@getDetail');

    /**
     * Get Search Listings
     * 
     * This is the function that will extract the queries and fetch it from database.
     */
    Route::get('listing/search', 'PostsController@getSearchListings');

    /**
     * Search Filter
     * 
     * This is where the search filter action uri will be pointed.
     */
    Route::post('search', 'HomeController@postSearch');
});

Route::group(array('before' => 'auth', 'namespace' => 'App\Controllers'), function() {
    ##Post comment
    Route::post('listing/{slug}/comment/submit', 'PostsController@postComment');
});

/**
 * USER PANEL
 */
Route::group(array('before' => 'auth', 'namespace' => 'App\Controllers\User'), function() {

    #Dashboard
    Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'PanelController@index'));

    #Update Profile
    Route::get('user/profile', 'UsersController@getProfile');
    Route::post('user/profile/submit', 'UsersController@postProfile');
    Route::get('user/profile', array('as' => 'profile', 'uses' => 'UsersController@getProfile'));

    #Update Password
    Route::get('user/password', 'UsersController@getPassword');
    Route::post('user/password/submit', 'UsersContproller@postPassword');
    Route::get('user/password', array('as' => 'password', 'uses' => 'UsersController@getPassword'));


    #LISTINGS
    Route::get('listing/manage', 'PostsController@index');

    ##Create new post listing (Detail and description)
    Route::get('listing/create', 'PostsController@getCreate');

    ##Submit new post listing
    Route::post("listing/submit", "PostsController@postCreate");

    ##Update post listing detail and description
    Route::get('listing/{code}/edit', 'PostsController@getEdit');
    Route::post('listing/{code}/submit', 'PostsController@postEdit');

    ##after create detail and description, popup modal to ask them to upload the image together with Generic Number
    Route::get('listing/{code}/photo', 'PostsController@getMedia');
    Route::post('listing/photo/submit', 'PostsController@postMedia');

    ##Update media of listing post
    Route::get('listing/{code}/photo/edit', 'PostsController@getMediaEdit');
    Route::post('listing/{code}/photo/submit', 'PostsController@getMediaEdit');

    ##Bump listing date expiry
    Route::get('listing/{code}/bump', 'PostsController@getBump');
    Route::post('listing/{code}/bump/submit', 'PostsController@postBump');
});

/**
 * API
 */
Route::group(array('prefix' => 'api/v1', 'namespace' => 'App\Controllers\Api'), function() {

    /*
     * /user - show all user
     * /user/{user_id} - show info of user
     * /user/{user_id}/listings - show all listings from user (GET)
     * /user/{user_id}/listings - submit new listing of user (POST)
     * /user/{user_id}/listings/create - create new listing of user - FORM
     * /user/{user_id}/listings/{slug} - show detail of listing of user
     */
    Route::resource('user', 'UserController', ['only' => ['show']]);
    Route::resource('user.listings', 'UserPostsController');


//    Route::resource('todos', 'TodosController');
//    Route::resource('auth', 'AuthController', array('only' => array('index')));
});
