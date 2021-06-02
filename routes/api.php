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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::namespace('App\Http\Controllers')->group(function(){
    Route::get('/comments', 'CommentController@fetchComments');
    Route::post('/comments', 'CommentController@store');
});

Route::middleware('auth:sanctum')->group(function(){
    Route::namespace('App\Http\Controllers')->group(function(){
        Route::get('/getcontacts', 'ContactController@index');
        Route::get('/getcurrent-user', 'ContactController@currentUser');
    });
});

Route::namespace('App\Http\Controllers')->group(function(){
    Route::get('/getsearch-contact/{user:id}', 'ContactController@search_contact');
    Route::get('/get-email/{user:email}', 'ManualAuthController@getEmail');  
});