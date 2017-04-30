<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth/login', [
    'as' => 'auth_login',
    'uses' => 'Api\Security\AuthController@authenticate'
]);

Route::get('/auth/logout', [
    'middleware' => 'nickel.jwt.auth',
    'as' => 'auth_logout',
    'uses' => 'Api\Security\AuthController@logout'
]);
