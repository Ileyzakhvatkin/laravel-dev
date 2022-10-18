<?php

namespace App\Http\Controllers;

use App\Events\ArticleCreated;
use App\Models\Article;
use App\Models\User;
use App\Notifications\ArticleCreationCompleted;
use App\Notifications\ArticleDeleteCompleted;
use App\Notifications\ArticleUpdateCompleted;
use App\Services\TagsSynchronizer;
use App\Services\FormRequest;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('can:update,article', ['except' => ['index', 'show', 'store', 'create']]);
    }

    public function index()
    {
        if ( Auth::user() !== null ) {
            $articles = Article::with('tags')->latest()->get();
        } else {
            $articles = Article::with('tags')->where('active', true)->latest()->get();
        }

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

    public function store(FormRequest $formRequest, TagsSynchronizer $tSync)
    {
        $article = Article::create($formRequest->articleCreate(request()));
        $formTags = collect(explode(',', request('tags')));
        $tSync->sync($formTags, $article);

        $article->owner->notify(new ArticleCreationCompleted($article));

        return redirect('/admin/article/create')->with('status', 'Статья успешно создана!');
    }

    public function edit(Article $article)
    {
        $success = false;

        return view('admin.edit-post', compact('article', 'success'));
    }

    public function update(Article $article, FormRequest $formRequest, TagsSynchronizer $tSync)
    {
        $formRequest->articleEdit($article, request());
        $formTags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; });
        $tSync->sync($formTags, $article);

        $article->owner->notify(new ArticleUpdateCompleted($article));

        return redirect('/admin/article/' . request('slug') . '/edit')->with('status', 'Статья успешно изменена!');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        $article->owner->notify(new ArticleDeleteCompleted($article));

        return redirect('/')->with('status', 'Статья ' . $article->title . ' удалена(');
    }
}
