<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Article;

Route::get('/article/tags/{tag}', 'App\Http\Controllers\TagsController@index');

Route::resource('/admin/article', 'App\Http\Controllers\PostsController');
Route::get('/', 'App\Http\Controllers\PostsController@home');
Route::get('/article/{article}', 'App\Http\Controllers\PostsController@show');

Route::get('/contacts', 'App\Http\Controllers\MessagesController@contacts');
Route::get('/admin/feedback', 'App\Http\Controllers\MessagesController@feedback');
Route::post('/contacts', 'App\Http\Controllers\MessagesController@store');
Route::get('/contacts-success', 'App\Http\Controllers\MessagesController@success');
Route::view('/about', 'pages.about');

Auth::routes();
