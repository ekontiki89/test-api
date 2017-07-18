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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    $user = fractal($request->user(), new \App\Transformers\UserTransformer())->toArray();
    return $user;
});

Route::group(['prefix' => 'auth'], function () {
    //Auth::routes();
    Route::post('password/email', 'Auth\ForgotPasswordController@getResetToken');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});

// Accounts endpoints
Route::get('accounts/getAccounts','AccountController@getAccounts')->middleware('auth:api');
Route::get('accounts', 'AccountController@index')->middleware('auth:api');
Route::post('accounts', 'AccountController@store')->middleware('auth:api');
Route::get('accounts/{uuid}', 'AccountController@edit')->middleware('auth:api');
Route::patch('accounts/{uuid}', 'AccountController@update')->middleware('auth:api');
Route::delete('accounts/{uuid}', 'AccountController@destroy')->middleware('auth:api');

// users endpoints
Route::get('users', 'UserController@index')->middleware('auth:api');
Route::post('users', 'UserController@store')->middleware('auth:api');
Route::get('users/{uuid}', 'UserController@edit')->middleware('auth:api');
Route::patch('users/{uuid}', 'UserController@update')->middleware('auth:api');
Route::delete('users/{uuid}', 'UserController@destroy')->middleware('auth:api');
