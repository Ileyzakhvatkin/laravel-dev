<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        abort_if(! \Auth::user()->isAdmin(),403);

        $bestAuthors = \DB::table('users')
            ->join('articles', 'users.id', '=', 'articles.owner_id')
            ->selectRaw('users.name, count(*) as user_articles_count')
            ->groupBy('users.name')
            ->orderBy('user_articles_count', 'DESC')
            ->get();

        $bestArticles = \DB::table('articles')
            ->selectRaw('title, LENGTH(articles.fulltext) as "text_length"')
            ->orderBy('text_length', 'DESC')
            ->get();

        $average = \DB::table('users')
            ->rightJoin('articles', 'users.id', '=', 'articles.owner_id')
            ->selectRaw('users.id, users.name, users.email, count(*) as user_articles_count')
            ->groupBy('users.id')
            ->pluck('user_articles_count');

        $history = \DB::table('articles')
            ->join('article_histories', 'articles.id', '=', 'article_histories.article_id')
            ->selectRaw('articles.title, count(*) as articles_histories_count')
            ->groupBy('articles.id')
            ->orderBy('articles_histories_count', 'DESC')
            ->get();

        $comments = \DB::table('articles')
            ->join('comments', 'articles.id', '=', 'comments.article_id')
            ->selectRaw('articles.title, count(*) as articles_comments_count')
            ->groupBy('articles.id')
            ->orderBy('articles_comments_count', 'DESC')
            ->get();

        $statisticsData = [
            'Общее количество статей' => \DB::table('articles')->count(),
            'Общее количество новостей' => \DB::table('news')->count(),
            'ФИО автора, у которого больше всего статей на сайте' => $bestAuthors->count() > 0 ? $bestAuthors->first()->name : 'нет публикаций у авторов',
            'Самая длинная статья' => $bestArticles->count() > 0
                ? $bestArticles->first()->title . ' (символов - ' . $bestArticles->first()->text_length . ')'
                : 'нет опубликованных статей',
            'Самая короткая статья' => $bestArticles->count() > 0
                ? $bestArticles->last()->title . ' (символов - ' . $bestArticles->last()->text_length . ')'
                : 'нет опубликованных статей',
            'Средние количество статей у активных пользователей' => $average->count() > 0 ?  $average->average() : 'нет опубликованных статей',
            'Самая непостоянная' => $history->count() > 0 ? $history->first()->title . ' (изменений - ' . $history->first()->articles_histories_count . ')' : 'нет изменений',
            'Самая обсуждаемая статья ' => $comments->count() > 0 ? $comments->first()->title . ' (коментариев - ' . $comments->first()->articles_comments_count . ')': 'нет коментариев',
        ];

        return view('admin.statistics', compact('statisticsData'));
    }
}
