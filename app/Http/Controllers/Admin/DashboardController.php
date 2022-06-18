<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{


    public function index()
    {
        $report = Report::select(DB::raw('sum(total_price) as total_price, sum(total_promotion) as total_promotion, sum(total_order) as total_order'))
            ->whereDate('date_created','=',date("Y/m/d"))->first();
        return view('Admin.index', ['report' => $report ?? '',
            'branchs' => Branch::all(),
            'date' => date("Y-m-d")
            ]);
    }

    public function searchReport(Request $request)
    {
        if($request->branch_id == 0) {
            $report = Report::select(DB::raw('sum(total_price) as total_price, sum(total_promotion) as total_promotion, sum(total_order) as total_order'))
                ->whereDate('date_created','=',$request->date)->first();
        } else {
            $report = Report::where('branch_id',$request->branch_id)
                ->whereDate('date_created','=',$request->date)->first();
        }
        
        if($report) {
            $report['total_price'] = number_format($report['total_price']);
            $report['total_promotion'] = number_format($report['total_promotion']);
        }
        
        return  ['report' => $report ?? [
                'total_price' => 0,
                'total_promotion' => 0,
                'total_order' => 0,
            ]
        ];
    }

    public function logout()
    {
        return 123;
    }

}
