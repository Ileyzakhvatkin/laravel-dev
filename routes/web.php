<?php

use Illuminate\Support\Facades\Route;

Route::get('/article/tegs/{teg}', 'App\Http\Controllers\TegsController@index');

Route::resource('/admin/article', 'App\Http\Controllers\PostsController');
Route::get('/', 'App\Http\Controllers\PostsController@index');
Route::get('/article/{article}', 'App\Http\Controllers\PostsController@show');

Route::get('/contacts', 'App\Http\Controllers\MessagesController@contacts');
Route::get('/admin/feedback', 'App\Http\Controllers\MessagesController@feedback');
Route::post('/contacts', 'App\Http\Controllers\MessagesController@store');
Route::get('/contacts-success', 'App\Http\Controllers\MessagesController@success');
Route::view('/about', 'pages.about');


