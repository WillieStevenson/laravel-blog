<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    // Your site landing page gets called here
    Route::get('/', 'HomeController@index');

    // Your site landing page gets called here
    Route::get('/about', 'HomeController@about');

    // Blog routes
    Route::get('/blog', 'BlogController@index')->middleware('guest');
    Route::get('/blog/{date}', 'BlogController@getPostsAtDate')->middleware('guest');
    Route::get('/blog/{date}/{slug}', 'BlogController@getPost')->middleware('guest');

    // Admin panel
    Route::get('/posts', 'PostController@index');
    Route::post('/post', 'PostController@store');
    Route::get('/post/{post}/edit', 'PostController@edit');
    Route::put('/post/{post}', 'PostController@update');
    Route::delete('/post/{post}', 'PostController@destroy');

    // Auth (login and register routes)
    // Authentication Routes...
    Route::auth();

    // Registration Routes...
    
    // Uncomment the below routes after you have registered a user

    // They over write the register routes to forbid users to enter the application

    // Route::get('register', function(){
    //     return view('errors.404');
    // });
    // Route::post('register', function(){
    //     return view('errors.404');
    // });

});
