<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Exports\HistoryExport;
use Maatwebsite\Excel\Facades\Excel;

class HistoryController extends Controller
{
    public function index()
    {
        return view('history.index');
    }

    public function downloadMonthly(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
        
        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();
        
        $fileName = "movimientos_mensuales_{$month}_{$year}.xlsx";
        
        return Excel::download(new HistoryExport($startDate, $endDate), $fileName);
    }

    public function downloadAnnual(Request $request)
    {
        $year = $request->input('year');
        
        $startDate = Carbon::create($year, 1, 1)->startOfYear();
        $endDate = Carbon::create($year, 12, 31)->endOfYear();
        
        $fileName = "movimientos_anuales_{$year}.xlsx";
        
        return Excel::download(new HistoryExport($startDate, $endDate), $fileName);
    }
}