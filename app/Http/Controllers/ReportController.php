<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function form()
    {


        return view('admin.report');
    }

    public function report()
    {
        $allTables = [
            'news' => 'Новости',
            'articles' => 'Статьи',
            'comments'=> 'Комментарии',
            'tags' => 'Теги',
            'users' => 'Пользователи',
        ];
        $requestTables = [
            'news' => 'on',
            'comments'=> 'on',
        ];
        $reportData = [];
        foreach ( $allTables as $key => $table ) {
            if ( array_key_exists($key, $requestTables) ) {
                $reportData[$table] = \DB::table($key)->count();
            }
        }

        return redirect('/admin/report')->with('report', $reportData);
    }
}
