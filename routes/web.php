<?php

use Illuminate\Support\Facades\Route;

use App\Models\Article;

Route::get('/', 'App\Http\Controllers\PostsController@index');
Route::get('/articles/create', 'App\Http\Controllers\PostsController@create');
Route::post('/articles/create', 'App\Http\Controllers\PostsController@store');
Route::get('/article/{slug}', 'App\Http\Controllers\PostsController@article');

Route::get('/contacts', 'App\Http\Controllers\MessagesController@contacts');
Route::get('/admin/feedback', 'App\Http\Controllers\MessagesController@feedback');
Route::post('/contacts', 'App\Http\Controllers\MessagesController@store');
Route::get('/contacts-success', 'App\Http\Controllers\MessagesController@success');

Route::get('/about', function () {
    return view('pages.about');
});
