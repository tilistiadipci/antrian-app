<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Models\Call;
use Carbon\Carbon;
use App\Models\Counter;

class DisplayRepository
{
    public function getSettings()
    {
        return Setting::first();
    }

    public function getCounters()
    {
        return Counter::all();
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
            $data[$i]['call_id'] = (isset($calls[$i]))?$calls[$i]->id:'-';
            $data[$i]['number'] = (isset($calls[$i]))?($calls[$i]->number):'-';
            $data[$i]['call_number'] = (isset($calls[$i]))?(($calls[$i]->department->letter!='')?$calls[$i]->department->letter.' '.$calls[$i]->number:$calls[$i]->number):'-';
            $data[$i]['namalayanan'] = (isset($calls[$i]))?$calls[$i]->department->name:'-';
            $data[$i]['layanan'] = (isset($calls[$i]))?$calls[$i]->department->letter:'-';
			$data[$i]['counter'] = (isset($calls[$i]))?$calls[$i]->counter->idcounter:'-';
            $data[$i]['namacounter'] = (isset($calls[$i]))?$calls[$i]->counter->name:'-';
            $data[$i]['durasi'] = (isset($calls[$i]))?$calls[$i]->counter->durasi:'-';
            $data[$i]['user_id'] = (isset($calls[$i]))?($calls[$i]->user_id):'-';

        }

        return $data;
    }
}
