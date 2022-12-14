<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\FormRequest;
use App\Services\TagsSynchronizer;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create,news', ['except' => ['index', 'show', 'more']]);
    }

    public function index()
    {
        $paginator = request()->get('page', 1);
        $posts = \Cache::tags(['news'])->remember('news_' . $paginator, 3600, function () use ($paginator) {
            return News::where('active', true)->latest()->simplePaginate(10, '*', 'page', $paginator);
        });

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
            'cat_list_slug' => 'news-list'
        ]);
    }

    public function more($news)
    {
        $post = \Cache::tags(['news'])->remember('news_more_' . $news, 3600, function () use ($news) {
            return News::where('slug', $news)->with('tags')->first();
        });

        return view('pages.post', [
            'post' => $post,
            'cat_list_slug' => 'news-list'
        ]);
    }

    public function create()
    {
        return view('admin.create-post', [
            'page_title' => 'Страница добавления новой новости',
            'cat_slug' => 'news',
        ]);
    }

    public function store(FormRequest $formRequest, TagsSynchronizer $tSync)
    {
        $news = News::create($formRequest->postCreate(request()));
        $formTags = collect(explode(',', request('tags')));
        $tSync->sync($formTags, $news);

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

    public function update(News $news, FormRequest $formRequest, TagsSynchronizer $tSync)
    {
        $formRequest->postEdit($news, request());
        $formTags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; });
        $tSync->sync($formTags, $news);
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
