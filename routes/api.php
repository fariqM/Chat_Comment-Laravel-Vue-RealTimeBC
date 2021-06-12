<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::namespace('App\Http\Controllers')->group(function () {
    // Web Application
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/getcurrent-user', 'ContactController@currentUser');
        Route::get('/getsearch-contact/{user:id}', 'ContactController@search_contact');
    });
    Route::get('/get-email/{user:email}', 'ManualAuthController@getEmail');
    Route::get('/comments', 'CommentController@fetchComments');
    Route::post('/comments', 'CommentController@store');
    Route::get('/bingu/getcurrent-user', 'ContactController@bingu');

    // mobile or API authentication and Authorization
    Route::namespace('Auth')->group(function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', 'AuthAPI@logout');
        });
        Route::post('login', 'AuthAPI@login');
        Route::post('register', 'AuthAPI@register');
    });
});
