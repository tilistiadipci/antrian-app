<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Setting;
use App\Models\Queue;
use App\Models\Call; 
use App\Models\Counter;
use App\Models\Department;
use Carbon\Carbon;

class DashbordRepository
{
    public function getSetting()
    {
        return Setting::first();
    }

    public function getTodayQueue()
    {
        return Queue::whereBetween('created_at', [Carbon::now()->format('Y-m-d').' 00:00:00', Carbon::now()->format('Y-m-d').' 23:59:59'])
                    ->count();

    }

    public function getTodayServed()
    {
        return Call::whereBetween('created_at', [Carbon::now()->format('Y-m-d').' 00:00:00', Carbon::now()->format('Y-m-d').' 23:59:59'])
                    ->count();
    }

    public function getUsers()
    {
        return User::all();
    }

    public function getCounters()
    {
        return Counter::all();
    }

    public function getDepartments()
    {
        return Department::all();
    }

    public function getTodayMissed()
    {
        $setting = $this->getSetting();

        $calls = Call::whereBetween('created_at', [Carbon::now()->format('Y-m-d').' 00:00:00', Carbon::now()->format('Y-m-d').' 23:59:59'])
                    ->get();

        $count = 0;
        foreach ($calls as $call) {
            $next_call_key = $calls->search(function($incall, $key) use($call) {
                if(($incall->id>$call->id) && ($incall->counter_id==$call->counter_id)) return $key;
            });

            if($next_call_key && ($calls[$next_call_key]->created_at->timestamp-$call->created_at->timestamp)<$setting->missed_time) $count++;
        }
        return $count;
    }

    public function getTodayOverTime()
    {
        $setting = $this->getSetting();

        $calls = Call::whereBetween('created_at', [Carbon::now()->format('Y-m-d').' 00:00:00', Carbon::now()->format('Y-m-d').' 23:59:59'])
                    ->get();

        $count = 0;
        foreach ($calls as $call) {
            $next_call_key = $calls->search(function($incall, $key) use($call) {
                if(($incall->id>$call->id) && ($incall->counter_id==$call->counter_id)) return $incall;
            });

            if($next_call_key && ($calls[$next_call_key]->created_at->timestamp-$call->created_at->timestamp)>$setting->over_time) $count++;
        }
        return $count;
    }

    public function getTodayCalls()
    {
        $counters = $this->getCounters();

        $count = [];
        foreach ($counters as $counter) {
            $count[] = $counter->calls()
                    ->whereBetween('created_at', [Carbon::now()->format('Y-m-d').' 00:00:00', Carbon::now()->format('Y-m-d').' 23:59:59'])
                    ->count();
        }

        return $count;
    }

    public function getYesterdayCalls()
    {
        $counters = $this->getCounters();

        $count = [];
        foreach ($counters as $counter) {
            $count[] = $counter->calls()
                    ->whereBetween('created_at', [Carbon::yesterday()->format('Y-m-d').' 00:00:00', Carbon::yesterday()->format('Y-m-d').' 23:59:59'])
                    ->count();
        }

        return $count;
    }

    public function updateNotification($data)
    {
        $setting = $this->getSetting();

        $setting->notification = $data['notification'];
        $setting->size = $data['size'];
        $setting->color = $data['color'];
        $setting->background_text = $data['background_text'];
        $setting->save();

        return $setting;
    }

    public function updateStyle($data)
    {
        $setting = $this->getSetting();

        $setting->background_menu = $data['background_menu'];
        $setting->size_company = $data['size_company'];
        $setting->size_logo_print = $data['size_logo_print'];
        $setting->size_text_tombol = $data['size_text_tombol'];
        $setting->size_logo = $data['size_logo'];
        $setting->save();

        return $setting;
    }

    public function updateStyledisplay($data)
    {
        $setting = $this->getSetting();

        $setting->background_panel_aa = $data['background_panel_aa'];
        $setting->background_panel_ab = $data['background_panel_ab'];
        $setting->background_panel_ba = $data['background_panel_ba'];
        $setting->background_panel_bb = $data['background_panel_bb'];
        $setting->background_panel_ca = $data['background_panel_ca'];
        $setting->background_panel_cb = $data['background_panel_cb'];
        $setting->background_panel_da = $data['background_panel_da'];
        $setting->background_panel_db = $data['background_panel_db'];
        $setting->color_teks_layanan = $data['color_teks_layanan'];
        $setting->color_teks_loket = $data['color_teks_loket'];
        $setting->color_teks_noangka = $data['color_teks_noangka'];
        $setting->save();

        return $setting;
    }

    public function getNextToken(Department $department)
    {
        return $department->queues()
                    ->where('called', 0)
                    ->where('created_at', '>', Carbon::now()->format('Y-m-d 00:00:00'))
                    ->first();
    }

    public function getLastToken(Department $department)
    {
        return $department->queues()
                    ->where('created_at', '>', Carbon::now()->format('Y-m-d 00:00:00'))
                    ->orderBy('created_at', 'desc')
                    ->first();
    }

    public function getCustomersWaiting(Department $department)
    {
        return $department->queues()
                    ->where('called', 0)
                    ->where('created_at', '>', Carbon::now()->format('Y-m-d 00:00:00'))
                    ->count();
    }
}
