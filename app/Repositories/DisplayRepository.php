<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Models\Call;
use Carbon\Carbon;
use App\Models\Counter;
use App\Template;

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

    public function getTemplate($id)
    {
        return Template::find($id);
    }

    public function getDisplayByTemplate($loop = 3, Template $template)
    {
        $departmentIds = $template->department_ids;
        $counterIds    = $template->counter_ids;

        // jika string JSON → decode
        if (is_string($departmentIds)) {
            $departmentIds = json_decode($departmentIds, true);
        }

        // jika string JSON → decode
        if (is_string($counterIds)) {
            $counterIds = json_decode($counterIds, true);
        }

        // fallback jika gagal decode
        $departmentIds = is_array($departmentIds) ? $departmentIds : [];
        $counterIds    = is_array($counterIds) ? $counterIds : [];

        $calls = Call::with('department', 'counter')
            ->where('called_date', Carbon::now()->format('Y-m-d'))
            ->whereIn('department_id', $departmentIds)
            ->whereIn('counter_id', $counterIds)
            ->orderBy('id', 'desc')
            ->take($loop)
            ->get();
        // dd($calls, $departmentIds, $counterIds);
        $data = [];
        for ($i = 0; $i < $loop; $i++) {
            $data[$i]['call_id'] = (isset($calls[$i])) ? $calls[$i]->id : '-';
            $data[$i]['number'] = (isset($calls[$i])) ? ($calls[$i]->number) : '-';
            $data[$i]['call_number'] = (isset($calls[$i])) ? (($calls[$i]->department->letter != '') ? $calls[$i]->department->letter . ' ' . $calls[$i]->number : $calls[$i]->number) : '-';
            $data[$i]['namalayanan'] = (isset($calls[$i])) ? $calls[$i]->department->name : '-';
            $data[$i]['layanan'] = (isset($calls[$i])) ? $calls[$i]->department->letter : '-';
            $data[$i]['counter'] = (isset($calls[$i])) ? $calls[$i]->counter->idcounter : '-';
            $data[$i]['namacounter'] = (isset($calls[$i])) ? $calls[$i]->counter->name : '-';
            $data[$i]['durasi'] = (isset($calls[$i])) ? $calls[$i]->counter->durasi : '-';
            $data[$i]['user_id'] = (isset($calls[$i])) ? ($calls[$i]->user_id) : '-';
            $data[$i]['dinamic_call'] = (isset($calls[$i])) ? $calls[$i]->counter->dinamic_call : '-';
            $data[$i]['call_type'] = (isset($calls[$i])) ? $calls[$i]->counter->call_type : '-';
        }

        return $data;
    }

    public function getDisplayData()
    {
        $calls = \DB::table('calls')
            ->join('departments', 'departments.id', '=', 'calls.department_id')
            ->join('counters', 'counters.id', '=', 'calls.counter_id')
            ->where('counters.idcounter', '!=', 0)
            ->where('calls.called_date', Carbon::now()->format('Y-m-d'))
            ->orderBy('calls.id', 'desc')
            ->limit(7)
            ->select(
                'calls.id',
                'calls.number',
                'calls.user_id',
                'departments.name as department_name',
                'departments.letter as department_letter',
                'counters.idcounter',
                'counters.name as counter_name',
                'counters.durasi'
            )
            ->get();

        $data = [];
        for ($i = 0; $i < 7; $i++) {
            $data[$i]['call_id'] = isset($calls[$i]) ? $calls[$i]->id : '-';
            $data[$i]['number'] = isset($calls[$i]) ? $calls[$i]->number : '-';
            $data[$i]['call_number'] = isset($calls[$i]) ? (($calls[$i]->department_letter != '') ? $calls[$i]->department_letter . ' ' . $calls[$i]->number : $calls[$i]->number) : '-';
            $data[$i]['namalayanan'] = isset($calls[$i]) ? $calls[$i]->department_name : '-';
            $data[$i]['layanan'] = isset($calls[$i]) ? $calls[$i]->department_letter : '-';
            $data[$i]['counter'] = isset($calls[$i]) ? $calls[$i]->idcounter : '-';
            $data[$i]['namacounter'] = isset($calls[$i]) ? $calls[$i]->counter_name : '-';
            $data[$i]['durasi'] = isset($calls[$i]) ? $calls[$i]->durasi : '-';
            $data[$i]['user_id'] = isset($calls[$i]) ? $calls[$i]->user_id : '-';
        }

        return $data;
    }
}
