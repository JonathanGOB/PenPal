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
Route::get('/v1/auth/signup/activate/{token}', 'Api\v1\AuthController@signupActivate');

Route::get('v1/auth/logout', 'Api\v1\AuthController@logout')->middleware('auth:api');
Route::get('v1/auth/user', 'Api\v1\AuthController@user')->middleware('auth:api');
Route::resource('v1/users', 'Api\v1\UserController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']])->middleware('auth:api');
Route::resource('v1/tags', 'Api\v1\TagController')->middleware('auth:api');
Route::resource('v1/occupations', 'Api\v1\OccupationController')->middleware('auth:api');
Route::resource('v1/countries', 'Api\v1\CountryController')->middleware('auth:api');
Route::resource('v1/nationalities', 'Api\v1\NationalityController')->middleware('auth:api');
Route::resource('v1/chatrooms', 'Api\v1\ChatroomController')->middleware('auth:api');

Route::post('v1/auth/create', 'PasswordResetController@create')->middleware('auth:api');
Route::get('v1/auth/find/{token}', 'PasswordResetController@find')->middleware('auth:api');
Route::post('v1/auth/reset', 'PasswordResetController@reset')->middleware('auth:api');
