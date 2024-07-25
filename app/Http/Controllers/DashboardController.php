<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DashbordRepository;

class DashboardController extends Controller
{
   protected $setting;

    public function __construct(DashbordRepository $setting)
    {
        $this->setting = $setting; 

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
