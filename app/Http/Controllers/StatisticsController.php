<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        abort_if(! \Auth::user()->isAdmin(),403);

//        $statisticsData = \Cache::tags(['articles', 'news', 'tags'])->remember('statistics_data', 3600, function () {
//            return $statisticsData;
//        });

        $statisticsData = [
            'countArticles' => Article::all()->count(),
            'countNews' => News::all()->count(),
            'longestArticle' => Article::get()->first(),
            'shortestArticle' => Article::get()->last(),
            'bestAuthor' => User::get()->last(),
            'averageArticle' => 100,
            'historyArticle' => Article::withCount('history')->orderByDesc('history_count')->first(),
            'commentsArticle' => Article::withCount('comments')->orderByDesc('comments_count')->first(),
        ];

        return view('admin.statistics', compact('statisticsData'));
    }
}
