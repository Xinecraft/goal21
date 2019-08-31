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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['middleware' => ['api','cors']], function () {
    Route::post('auth/register', 'Auth\ApiRegisterController@register');
    Route::post('auth/login', 'Auth\ApiAuthController@login');
    Route::post('auth/logout', 'Auth\ApiAuthController@logout');
    Route::post('auth/refresh', 'Auth\ApiAuthController@refresh');
    Route::post('auth/me', 'Auth\ApiAuthController@me');
    Route::get('auth/tasks', 'Auth\ApiAuthController@getTasks');
    Route::get('auth/task/{uuid}', 'Auth\ApiAuthController@getOneTask');
    Route::post('auth/task/{uuid}/complete', 'Auth\ApiAuthController@postCompleteTask');
});
