<?php

namespace App\Repositories;

use App\Models\User; 
use App\Models\Setting;
use App\Models\Department;
use App\Models\Counter;
use App\Models\Queue;
use Carbon\Carbon;
use App\Models\Call;

class CallRepository
{
    public function getUsers()
    {
        return User::all();
    }

    public function getSettings()
    {
        return Setting::first();
    }

    public function getCounters()
    {
        return Counter::all();
    }

    public function getDepartments()
    {
        return Department::all();
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

    public function getTodayQueue()
    {
    
        return Queue::whereBetween('created_at', [Carbon::now()->format('Y-m-d').' 00:00:00', Carbon::now()->format('Y-m-d').' 23:59:59'])
                    ->where('called', 0)
                    ->count();

    }

    public function getDisplayData()
    {
        $calls = Call::with('department', 'counter')
                    ->where('called_date', Carbon::now()->format('Y-m-d'))
                    ->orderBy('id', 'desc')
                    ->take(7)
                    ->get();

        $data = [];
        for ($i=0;$i<7;$i++) {
            $data[$i]['call_id'] = (isset($calls[$i]))?$calls[$i]->id:'0';
            $data[$i]['number'] = (isset($calls[$i]))?($calls[$i]->number):'0';
            $data[$i]['call_number'] = (isset($calls[$i]))?(($calls[$i]->department->letter!='')?$calls[$i]->department->letter.' '.$calls[$i]->number:$calls[$i]->number):'0';
            $data[$i]['namalayanan'] = (isset($calls[$i]))?$calls[$i]->department->name:'0';
            $data[$i]['layanan'] = (isset($calls[$i]))?$calls[$i]->department->letter:'0';
            $data[$i]['counter'] = (isset($calls[$i]))?$calls[$i]->counter->idcounter:'0';
            $data[$i]['namacounter'] = (isset($calls[$i]))?$calls[$i]->counter->name:'0';
            $data[$i]['durasi'] = (isset($calls[$i]))?$calls[$i]->counter->durasi:'0';
            $data[$i]['user_id'] = (isset($calls[$i]))?($calls[$i]->user_id):'0';

        }

        return $data;
    }
}
