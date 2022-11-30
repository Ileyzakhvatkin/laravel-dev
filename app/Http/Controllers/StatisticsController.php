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
                'longestArticle' => Article::all()->each->append([ 'length_text' ])->sortBy('length_text')->first(),
                'shortestArticle' => Article::all()->each->append([ 'length_text' ])->sortBy('length_text')->last(),
                'bestAuthor' => User::withCount('articles')->orderByDesc('articles_count')->first(),
                'averageArticle' => User::has('articles')->withCount('articles')->pluck('articles_count')->avg(),
                'historyArticle' => Article::withCount('history')->orderByDesc('history_count')->first(),
                'commentsArticle' => Article::withCount('comments')->orderByDesc('comments_count')->first(),
            ];
        });

        return view('admin.statistics', compact('statData'));
    }
}
