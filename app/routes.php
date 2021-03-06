<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
// route to show the login form
Route::get('login', 'HomeController@showLogin');
// route to process the login form
Route::post('login', 'HomeController@doLogin');
Route::get('logout', 'HomeController@doLogout');
Route::get('register', 'HomeController@showRegister');
Route::post('register', 'HomeController@doRegister');

Route::get('/albums', 'AlbumController@index');
Route::get('/album/makeNew', 'AlbumController@makeNew');
Route::post('/album/create', 'AlbumController@create');
Route::get('/album/show/{id}', 'AlbumController@show');
Route::get('/album/{id}/images/{imgid}', 'AlbumController@getImages');
Route::get('/album/upload/{id}', 'AlbumController@upload');
Route::post('/album/upload/{id}', 'AlbumController@saveFile');

Route::get('/album/{id}/edit', 'AlbumController@edit');
Route::post('/album/{id}/update', 'AlbumController@update');



Route::get('/images/show/{id}', 'ImageController@show');
Route::get('/images/destroy/{id}', 'ImageController@destroy')->where('id', '[0-9]+');

Route::get('/comments/{id}', 'CommentController@index')->where('id', '[0-9]+');
Route::post('/comments/store', 'CommentController@store');
Route::post('/comments/destroy/{id}', 'CommentController@destroy')->where('id', '[0-9]+');

Route::post('/likes/update/{id}', 'LikeController@update')->where('id', '[0-9]+');