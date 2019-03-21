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
Route::resource('/post', 'PostController')->middleware('auth');

Route::get('/admin', 'AdminController@index')->middleware('isadmin', 'auth');
Route::post('/admin/{user}', 'AdminController@toggle')->middleware('isadmin', 'auth');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'FeedController@index');


Route::get('/category', 'PostController@categories');
Route::get('/category/{category_id}', 'FeedController@category');

Route::get('/{seo_url}', 'FeedController@post');

