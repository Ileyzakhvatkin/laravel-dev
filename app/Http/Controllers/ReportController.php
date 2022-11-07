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
            'news' => 'Новостей',
            'articles' => 'Статей',
            'comments'=> 'Комментариев',
            'tags' => 'Тегов',
            'users' => 'Пользователей',
        ];
        $reportData = [];
        foreach ( $allTables as $key => $table ) {
            if ( array_key_exists($key, \request()->all() ) ) {
                $reportData[$table] = \DB::table($key)->count();
            }
        }
        return redirect('/admin/report')->with('report', $reportData);
    }
}
