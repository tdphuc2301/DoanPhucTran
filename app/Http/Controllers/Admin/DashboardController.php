<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;


class DashboardController extends Controller
{


    public function index()
    {
        return view('Admin.index');
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
