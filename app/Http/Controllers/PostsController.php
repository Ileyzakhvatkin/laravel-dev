<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\TagsSynchronizer;
use MyHelpers\FormRequest;

class PostsController extends Controller
{
    public function index()
    {
        $articles = Article::with('tags')->where('active', '=', true)->latest()->get();

        return view('index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('pages.article', compact('article'));
    }

    public function create()
    {
        return view('admin.create-post');
    }

    public function store(TagsSynchronizer $tSync)
    {
        $validateRes = new FormRequest();
        $validateRes->validateCreate(request());

        $article = Article::create([
            'slug' => request('slug'),
            'title' => request('title'),
            'brief' => request('brief'),
            'fulltext' => request('fulltext'),
            'active' => (bool)request('active')
        ]);
        $formTags = collect(explode(',', request('tags')));
        $tSync->sync($formTags, $article);

        return redirect('/admin/article/create')->with('status', 'Статья успешно создана!');
    }

    public function edit(Article $article)
    {
        $success = false;

        return view('admin.edit-post', compact('article', 'success'));
    }

    public function update(Article $article, TagsSynchronizer $tSync)
    {
        $validateRes = new FormRequest();
        $validateRes->validateEdit(request());

        $article->slug = request('slug');
        $article->title = request('title');
        $article->brief = request('brief');
        $article->fulltext = request('fulltext');
        $article->active = (bool)request('active');
        $article->save();

        $formTags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; });

        $tSync->sync($formTags, $article);

        return redirect('/admin/article/' . request('slug') . '/edit')->with('status', 'Статья успешно изменена!');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect('/')->with('status', 'Статья ' . $article->title . ' удалена(');
    }
}
