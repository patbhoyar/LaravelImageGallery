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

// route to show the login form
Route::get('login', 'HomeController@showLogin');
// route to process the form
Route::post('login', 'HomeController@doLogin');
Route::get('logout', array('uses' => 'HomeController@doLogout'));

Route::get('/albums', 'AlbumController@index');
Route::get('/album/makeNew', 'AlbumController@makeNew');
Route::post('/album/create', 'AlbumController@create');
Route::get('/album/show/{id}', 'AlbumController@show');
Route::get('/album/{id}/images/{imgid}', 'AlbumController@getImages');
Route::get('/album/upload/{id}', 'AlbumController@upload');
Route::post('/album/upload/{id}', 'AlbumController@saveFile');



Route::get('/', 'ImageController@allImages');
Route::get('/images/show/{id}', 'ImageController@show');
Route::get('/images/destroy/{id}', 'ImageController@destroy')->where('id', '[0-9]+');

Route::get('/comments/{id}', 'CommentController@index')->where('id', '[0-9]+');
Route::post('/comments/store', 'CommentController@store');
Route::post('/comments/destroy/{id}', 'CommentController@destroy')->where('id', '[0-9]+');

Route::post('/likes/update/{id}', 'LikeController@update')->where('id', '[0-9]+');