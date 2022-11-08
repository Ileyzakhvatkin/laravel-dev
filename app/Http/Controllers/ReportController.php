<?php

namespace App\Http\Controllers;

use App\Jobs\MaterialsSiteReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function form()
    {
        abort_if(! \Auth::user()->isAdmin(),403);

        return view('admin.report');
    }

    public function report()
    {
        abort_if(! \Auth::user()->isAdmin(),403);

        MaterialsSiteReport::dispatchNow(Auth::user());
        flash('Отчет будет отправлен Вам на e-mail', 'success');

        $params = ['news', 'articles', 'comments', 'tags', 'users'];
        $reportData = [];
        foreach ( $params as $param ) {
            if ( array_key_exists($param, \request()->all()) ) {
                $reportData[] = $param;
            }
        }

        return redirect('/admin/report')->with('report', $reportData);
    }
}
