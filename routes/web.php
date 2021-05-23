<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [App\Http\Controllers\CommentController::class, 'index']);

Route::view('/{any}', 'layouts.app')->where('any','.*');
// Auth::routes();
// Route::middleware('auth:sanctum')->group(function(){
//     Route::view('/auth/{any}', 'welcome')->where('any','.*');
// });



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
