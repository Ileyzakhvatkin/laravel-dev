<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $articles = Article::where('active', '=', true)->latest()->get();
        return view('index', compact('articles'));
    }

    public function article($slug)
    {
        $article = Article::where('slug', '=', $slug)->get()->first();
        return view('pages.article', compact('article'));
    }

    public function create()
    {
        return view('admin.create-post');
    }

    public function store()
    {
        $this->validate(request(), [
            'slug' => 'required|string|max:255|regex:/^[0-9a-z\-\_]+$/i|unique:articles,slug',
            'title' => 'required|min:5|max:100',
            'brief' => 'required|max:255',
            'fulltext' => 'required',
        ]);

        Article::create([
            'slug' => request('slug'),
            'title' => request('title'),
            'brief' => request('brief'),
            'fulltext' => request('fulltext'),
            'active' => (bool)request('active'),
        ]);

        return redirect('/articles/create');
    }
}
