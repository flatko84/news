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
use App\Posts;

Auth::routes();
Route::resource('/post', 'PostController')->middleware('auth');

Route::get('/admin', 'AdminController@index')->middleware('isadmin');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'FeedController@index');
Route::get('/{seo_url}', 'FeedController@post');
Route::get('/category/{category_id}', 'FeedController@category');
