<?php

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

Route::view('/','index');
Route::resource('posts','PostsController');
Auth::routes();
Route::get('/myblog','PostsController@myblog')->name('myblog');
Route::get('/home', 'HomeController@index')->name('home');
