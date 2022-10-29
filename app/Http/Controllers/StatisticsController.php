<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        abort_if(! \Auth::user()->isAdmin(),403);
        $statisticsData = [
            'Общее количество статей' => 10,
            'Общее количество новостей' => 10,
            'ФИО автора, у которого больше всего статей на сайте' => 10,
            'Самая длинная статья' => 10,
            'Самая короткая статья' => 10,
            'Средние количество статей у активных пользователей' => 10,
            'Самая непостоянная' => 10,
            'Самая обсуждаемая статья ' => 10,
        ];
        return view('admin.statistics', compact('statisticsData'));
    }
}
