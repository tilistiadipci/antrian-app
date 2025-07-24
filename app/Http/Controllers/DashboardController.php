<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DashbordRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
   protected $setting;

    public function __construct(DashbordRepository $setting)
    {
        $this->setting = $setting; 

    }

    public function downloadTamu()
    {
        $filename = 'laporan_tamu_' . date('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () {
        $handle = fopen('php://output', 'w');

        // Header kolom CSV
        fputcsv($handle, ['Nama Tamu', 'No HP', 'Dinas Lembaga', 'Nama Sales', 'Tanggal']);

            // Ambil data dari DB
            $guests = DB::table('guests')
                ->join('sales', 'guests.sales_id', '=', 'sales.id')
                ->select(
                    'guests.name as guest_name',
                    'guests.no_hp as phone',
                    'guests.dinas as dinas',
                    'sales.name as sales_name',
                    'guests.created_at'
                )
                ->get();

            // Isi baris CSV
            foreach ($guests as $row) {
                fputcsv($handle, [
                    $row->guest_name,
                    $row->phone,
                    $row->dinas,
                    $row->sales_name,
                    $row->created_at,
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    

    public function index()
    {
        

        return view('user.dashboard.index', [
            'setting' => $this->setting->getSetting(),
            'today_queue' => $this->setting->getTodayQueue(),
            'missed' => $this->setting->getTodayMissed(),
            'overtime' => $this->setting->getTodayOverTime(),
            'served' => $this->setting->getTodayServed(),
            'counters' => $this->setting->getCounters(),
            'today_calls' => $this->setting->getTodayCalls(),
            'yesterday_calls' => $this->setting->getYesterdayCalls(),
        ]);

        
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'notification' => 'bail|required|min:5',
            'size' => 'bail|required|numeric',
            'color' => 'required',
        ]);

        $setting = $this->setting->updateNotification($request->all());

        flash()->success('Notification updated');
        return redirect()->route('dashboard');
    }

    public function style(Request $request)
    {
        $this->validate($request, [
            'size_company' => 'required',
        ]);

        $setting = $this->setting->updateStyle($request->all());

        flash()->success('Style updated');
        return redirect()->route('dashboard');
    }

    public function styledisplay(Request $request)
    {
        $this->validate($request, [
            'background_panel_aa' => 'required',
        ]);

        $setting = $this->setting->updateStyledisplay($request->all());

        flash()->success('Style Display updated');
        return redirect()->route('dashboard');
    }
}
