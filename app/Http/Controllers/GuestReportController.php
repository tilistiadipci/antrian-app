<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\Guest;
use Carbon\Carbon;

class GuestReportController extends Controller
{
    public function index(Request $request)
    {
        $guests = $this->query($request)->with('sales')->get();

        return view('user.reports.guest.index', [
            'sales' => Sales::all(),
            'guests' => $guests
        ]);
    }

    private function query($request)
    {
        $query = Guest::query();

        if ($request->has('sales') && $request->sales != 'all') {
            $query->where('sales_id', $request->sales);
        }

        $sdate = date('Y-m-d');
        $edate = date('Y-m-d');

        if ($request->has('sdate')) {
            $sdate = Carbon::createFromFormat('d-m-Y', $request->sdate)->format('Y-m-d');
        }

        if ($request->has('edate')) {
            $edate = Carbon::createFromFormat('d-m-Y', $request->edate)->format('Y-m-d');
        }

        $query->whereDate('created_at', '>=', $sdate);
        $query->whereDate('created_at', '<=', $edate);

        return $query;
    }
}
