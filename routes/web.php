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



Route::get('/myposts' , 'publish@getPosts')->name('myposts')->middleware('auth');
Route::get('/postform/{post_id?}', 'publish@postForm')->name('postform')->middleware('auth');
Route::post('/publish', 'publish@publishPost')->name('publish')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'feed@index');
Route::get('{seo_url}', 'feed@post');
