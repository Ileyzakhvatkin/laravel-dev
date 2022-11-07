<?php

namespace App\Http\Controllers;

use App\Jobs\MaterialsSiteReport;
use Illuminate\Http\Request;

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

        return redirect('/admin/report')->with('report', MaterialsSiteReport::dispatchNow());
    }
}
