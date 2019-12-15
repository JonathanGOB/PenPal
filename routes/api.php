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


Route::post('v1/auth/register', 'Api\v1\AuthController@register');
Route::post('v1/auth/login', 'Api\v1\AuthController@authenticate');

Route::get('v1/auth/logout', 'Api\v1\AuthController@logout')->middleware('auth:api');;
Route::get('v1/auth/user', 'Api\v1\AuthController@user')->middleware('auth:api');;
Route::get('v1/user', 'Api\v1\UserController@index')->middleware('auth:api');
