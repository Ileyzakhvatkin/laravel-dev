<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Article;

Route::get('/article/tags/{tag}', 'App\Http\Controllers\TagsController@index');

Route::get('/test', function() {
    dd( User::withCount('articles')->orderByDesc('articles_count')->first() );
});

Route::resource('/admin/article', 'App\Http\Controllers\ArticleController');
Route::resource('/admin/news', 'App\Http\Controllers\NewsController');

Route::get('/', 'App\Http\Controllers\ArticleController@home');
Route::get('/news', 'App\Http\Controllers\NewsController@index');

Route::get('/article/{article}', 'App\Http\Controllers\ArticleController@more');
Route::get('/news/{news}', 'App\Http\Controllers\NewsController@more');

Route::get('/contacts', 'App\Http\Controllers\MessagesController@contacts');
Route::get('/admin/feedback', 'App\Http\Controllers\MessagesController@feedback');
Route::post('/contacts', 'App\Http\Controllers\MessagesController@store');

Route::view('/about', 'pages.about');
Route::get('/admin/statistics', 'App\Http\Controllers\StatisticsController@index');

Route::get('/admin/service', 'App\Http\Controllers\PushServiceController@form');
Route::post('/admin/service', 'App\Http\Controllers\PushServiceController@send');

Route::get('/admin/report', 'App\Http\Controllers\ReportController@form');
Route::post('/admin/report', 'App\Http\Controllers\ReportController@report');

Route::post('/article/{article}', 'App\Http\Controllers\ArticleCommentsController@store');

Auth::routes();
