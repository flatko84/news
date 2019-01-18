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

Auth::routes();
Route::resource('/post', 'PostController')->middleware('auth')->names('post');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'feed@index');
Route::get('{seo_url}', 'feed@post');


