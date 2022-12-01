<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\News;

class StatisticsController extends Controller
{
    public function index()
    {
        abort_if(! \Auth::user()->isAdmin(),403);

       $statData = \Cache::tags(['articles', 'news', 'tags', 'comments'])->remember('statistics_data', 3600, function () {

            return $statData = [
                'countArticles' => Article::count(),
                'countNews' => News::count(),
                'longestArticle' => Article::selectRaw('title, slug, LENGTH(articles.fulltext) as "text_count"')
                    ->orderBy('text_count', 'ASC')
                    ->first(),
                'shortestArticle' => Article::selectRaw('title, slug, LENGTH(articles.fulltext) as "text_count"')
                    ->orderBy('text_count', 'DESC')
                    ->first(),
                'bestAuthor' => User::withCount('articles')->orderByDesc('articles_count')->first(),
                'averageArticle' => User::has('articles')->withCount('articles')->pluck('articles_count')->avg(),
                'historyArticle' => Article::withCount('history')->orderByDesc('history_count')->first(),
                'commentsArticle' => Article::withCount('comments')->orderByDesc('comments_count')->first(),
            ];
        });

        return view('admin.statistics', compact('statData'));
    }
}
