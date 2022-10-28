<?php

namespace App\Http\Controllers;

use App\Events\ArticleCreated;
use App\Models\Article;
use App\Models\User;
use App\Notifications\ArticleCreationCompleted;
use App\Notifications\ArticleDeleteCompleted;
use App\Notifications\ArticleUpdateCompleted;
use App\Services\Pushall;
use App\Services\TagsSynchronizer;
use App\Services\FormRequest;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['home', 'index', 'show']]);
        $this->middleware('can:update,article', ['except' => ['home', 'index', 'show', 'store', 'create']]);
    }

    public function index()
    {
        if ( Auth::user()->isAdmin() ) {
            $articles = Article::with('tags')->latest()->get();
        } else {
            $articles = auth()->user()->articles()->with('tags')->latest()->get();
        }

        return view('admin.articles', compact('articles'));
    }

    public function home()
    {
        $articles = Article::with('tags')->where('active', true)->latest()->get();

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

    public function store(FormRequest $formRequest, TagsSynchronizer $tSync, Pushall $pushall)
    {
        $article = Article::create($formRequest->articleCreate(request()));
        $formTags = collect(explode(',', request('tags')));
        $tSync->sync($formTags, $article);

        $article->owner->notify(new ArticleCreationCompleted($article));

        push_all('Создана новая статья - ' . $article->title, $article->brief);

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
        $article->owner->notify(new ArticleDeleteCompleted($article));
        $article->delete();

        return redirect('/admin/article')->with('status', 'Статья ' . $article->title . ' удалена(');
    }
}
