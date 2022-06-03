<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{


    public function index()
    {
        $report = Report::where([
            ['date_created', '=',date("Y/m/d")],
            ['branch_id', '=',Auth::user()->branch_id]
            ])->get();
        return view('Admin.index', ['report' => $report[0] ?? '' ]);
    }

    public function logout()
    {
        return 123;
    }

    public function report()
    {
        $report = Report::all();
        return $report;
    }

}
