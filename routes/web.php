<?php

/*
| Authenticated routes
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', ['as' => 'home_page', 'uses' => 'DefaultController@index']);
    Route::get('/home', ['uses' => 'DefaultController@index']);

    /*
    | User management
    |--------------------------------------------------------------------------
    |
    */
    Route::group(['prefix' => '/users'], function () {
        Route::get('/', ['as' => 'users_list', 'uses' => 'UserController@index']);
        Route::get('/logs', ['as' => 'users_logs', 'uses' => 'UserController@logs']);
        Route::post('/', ['as' => 'users_add', 'uses' => 'UserController@store']);
        Route::delete('/{id}', ['as' => 'users_delete', 'uses' => 'UserController@delete']);
    });

});

/*
| Not authenticated routes
|--------------------------------------------------------------------------
|
*/
Route::group([], function () {

});

/*
| Built in routes
|--------------------------------------------------------------------------
|
*/
Auth::routes();
