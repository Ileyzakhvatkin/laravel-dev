<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        abort_if(! \Auth::user()->isAdmin(),403);

        $statisticsData = \Cache::tags(['articles', 'articles_more', 'news', 'news_more'])->remember('statistics_data', 3600, function () {

            $bestAuthors = \DB::table('users')
                ->join('articles', 'users.id', '=', 'articles.owner_id')
                ->selectRaw('users.name, count(*) as item_count')
                ->groupBy('users.name')
                ->orderBy('item_count', 'DESC')
                ->get();

            $bestArticles = \DB::table('articles')
                ->selectRaw('title, slug, LENGTH(articles.fulltext) as "item_count"')
                ->orderBy('item_count', 'DESC')
                ->get();

            $average = \DB::table('users')
                ->rightJoin('articles', 'users.id', '=', 'articles.owner_id')
                ->selectRaw('users.id, users.name, users.email, count(*) as item_count')
                ->groupBy('users.id')
                ->pluck('item_count');

            $history = \DB::table('articles')
                ->join('article_histories', 'articles.id', '=', 'article_histories.article_id')
                ->selectRaw('articles.title, articles.slug, count(*) as item_count')
                ->groupBy('articles.id')
                ->orderBy('item_count', 'DESC')
                ->get();

            $comments = \DB::table('articles')
                ->join('comments', 'articles.id', '=', 'comments.article_id')
                ->selectRaw('articles.title, articles.slug, count(*) as item_count')
                ->groupBy('articles.id')
                ->orderBy('item_count', 'DESC')
                ->get();

            $statisticsData = [
                'Общее количество статей' => \DB::table('articles')->count(),
                'Общее количество новостей' => \DB::table('news')->count(),
                'ФИО автора, у которого больше всего статей на сайте' => $bestAuthors->count() > 0
                    ? $bestAuthors->first()->name
                    : 'нет публикаций у авторов',
                'Самая длинная статья' => $bestArticles->count() > 0
                    ? $bestArticles->first()
                    : 'нет опубликованных статей',
                'Самая короткая статья' => $bestArticles->count() > 0
                    ? $bestArticles->last()
                    : 'нет опубликованных статей',
                'Средние количество статей у активных пользователей' => $average->count() > 0
                    ?  $average->average()
                    : 'нет опубликованных статей',
                'Самая непостоянная статья' => $history->count() > 0
                    ? $history->first()
                    : 'нет изменений',
                'Самая обсуждаемая статья ' => $comments->count() > 0
                    ? $comments->first()
                    : 'нет коментариев',
            ];

            return $statisticsData;
        });

        return view('admin.statistics', compact('statisticsData'));
    }
}
