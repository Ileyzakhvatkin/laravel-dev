<?php

namespace App\Http\Controllers;

use App\Models\Article;
use MyHelpers\FormRequest;

class PostsController extends Controller
{
    public function index()
    {
        $articles = Article::where('active', '=', true)->latest()->get();
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

    public function store()
    {
        $validateRes = new FormRequest();
        $validateRes->validateCreate(request());

        Article::create([
            'slug' => request('slug'),
            'title' => request('title'),
            'brief' => request('brief'),
            'fulltext' => request('fulltext'),
            'active' => (bool)request('active'),
        ]);

        return redirect('/admin/article/create')->with('status', 'Статья успешно создана!');
    }

    public function edit(Article $article)
    {
        $success = false;
        return view('admin.edit-post', compact('article', 'success'));
    }

    public function update(Article $article)
    {
        $validateRes = new FormRequest();
        $validateRes->validateEdit(request());

        $article->slug = request('slug');
        $article->title = request('title');
        $article->brief = request('brief');
        $article->fulltext = request('fulltext');
        $article->active = (bool)request('active');
        $article->save();

        return redirect('/admin/article/' . request('slug') . '/edit')->with('status', 'Статья успешно изменена!');;
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect('/')->with('status', 'Статья ' . $article->title . ' удалена(');;
    }
}
