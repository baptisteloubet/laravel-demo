<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SujetController;
use App\Http\Controllers\CommentController;


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

Route::post('/comments/{sujet}', 'CommentController@store')->name('comments.store');

Route::delete('/comments', 'CommentController@destroy')->name('comments.destroy');


Route::get('/', 'SujetController@index')->name('sujet.index');

Route::resource('sujets', 'SujetController')->except(['index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
