<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\FormRequest;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create,news', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $posts = News::where('active', true)->latest()->simplePaginate(10);

        return view('index', [
            'posts' => $posts,
            'page_title' => 'Новости портала',
            'cat_slug' => 'news',
            'empty_post' => 'На сайте не опубликовано ни одной новости!',
        ]);
    }

    public function show(News $news)
    {
        return view('pages.post', [
            'post' => $news,
            'return_url' => '/news',
        ]);
    }

    public function create()
    {
        return view('admin.create-post', [
            'page_title' => 'Страница добавления новой новости',
            'cat_slug' => 'news',
        ]);
    }

    public function store(FormRequest $formRequest)
    {
        News::create($formRequest->postCreate(request()));
        flash('Новость успешно создана!', 'success');

        return redirect('/admin/news/create');
    }

    public function edit(News $news)
    {
        return view('admin.edit-post', [
            'post' => $news,
            'page_title' => 'Страница редактирования новости',
            'cat_slug' => 'news',
        ]);
    }

    public function update(News $news, FormRequest $formRequest)
    {
        $formRequest->postEdit($news, request());
        flash('Новость успешно изменена!', 'success');

        return redirect('/admin/news/' . request('slug') . '/edit');
    }

    public function destroy(News $news)
    {
        $news->delete();
        flash('Новость "' . $news->title . '" удалена.', 'success');

        return redirect('/news');
    }
}
