<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Notifications\ArticleCreationCompleted;
use App\Notifications\ArticleDeleteCompleted;
use App\Notifications\ArticleUpdateCompleted;
use App\Services\Pushall;
use App\Services\TagsSynchronizer;
use App\Services\FormRequest;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['home', 'index', 'show', 'more']]);
        $this->middleware('can:update,article', ['except' => ['home', 'index', 'show', 'more', 'store', 'create']]);
    }

    public function index()
    {
        if ( Auth::user()->isAdmin() ) {
            $posts = Article::with('tags')->latest()->simplePaginate(20);
        } else {
            $posts = Article::where('owner_id', auth()->id())->with('tags')->latest()->simplePaginate(20);
        }

        return view('admin.posts', [
            'posts' => $posts,
            'page_title' => 'Статьи доступные для редактирования',
            'cat_slug' => 'article',
            'empty_post' => 'На сайте не опубликовано ни одной статьи!',
        ]);
    }

    public function home()
    {
        $paginator = request()->get('page', 1);
        $posts = \Cache::tags(['articles'])
            ->remember('articles_page_' . $paginator, 3600, function () use ($paginator) {
                return Article::with('tags')->where('active', true)->latest()->simplePaginate(10, '*', 'page', $paginator);
            });

        return view('index', [
            'posts' => $posts,
            'page_title' => 'Опубликованные статьи',
            'cat_slug' => 'article',
            'empty_post' => 'На сайте не опубликовано ни одной статьи!',
        ]);
    }

    public function show(Article $article)
    {
        return view('pages.post', [
            'post' => $article,
        ]);
    }

    public function more($article)
    {
        $post = \Cache::tags(['articles', 'tags', 'comments'])->remember('article_more_' . $article, 3600, function () use ($article) {
            return Article::where('slug', $article)->with(['tags', 'comments'])->first();
        });

        return view('pages.post', [
            'post' => $post,
            'cat_list_slug' => 'article-list'
        ]);
    }

    public function create()
    {
        return view('admin.create-post', [
            'page_title' => 'Страница добавления новой статьи',
            'cat_slug' => 'article',
        ]);
    }

    public function store(FormRequest $formRequest, TagsSynchronizer $tSync, Pushall $pushall)
    {
        $article = Article::create($formRequest->postCreate(request()));
        $formTags = collect(explode(',', request('tags')));
        $tSync->sync($formTags, $article);

        $article->owner->notify(new ArticleCreationCompleted($article));

        push_all('Создана новая статья - ' . $article->title, $article->brief);
        flash('Статья успешно создана!', 'success');

        return redirect('/admin/article/create');
    }

    public function edit(Article $article)
    {
        return view('admin.edit-post', [
            'post' => $article,
            'page_title' => 'Страница редактирования статьи',
            'cat_slug' => 'article',
        ]);
    }

    public function update(Article $article, FormRequest $formRequest, TagsSynchronizer $tSync)
    {
        $formRequest->postEdit($article, request());
        $formTags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; });
        $tSync->sync($formTags, $article);

        $article->owner->notify(new ArticleUpdateCompleted($article, array_keys($article->getChanges())));

        flash('Статья успешно изменена!', 'success');

        return redirect('/admin/article/' . request('slug') . '/edit');
    }

    public function destroy(Article $article)
    {
        $article->owner->notify(new ArticleDeleteCompleted($article));
        $article->delete();
        flash('Статья "' . $article->title . '" удалена.', 'success');

        return redirect('/admin/article');
    }
}
