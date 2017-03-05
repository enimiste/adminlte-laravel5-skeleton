<?php

/*
| Authenticated routes
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => 'auth'], function () {

});

/*
| Not authenticated routes
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', ['as' => 'home_page', 'uses' => 'DefaultController@index']);
});

/*
| Built in routes
|--------------------------------------------------------------------------
|
*/
Auth::routes();
