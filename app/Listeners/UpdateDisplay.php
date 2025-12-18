<?php

namespace App\Listeners;

use App\Events\TokenCalled;
use App\Models\Call;
use App\Template;
use Carbon\Carbon;

class UpdateDisplay
{
    public function __construct()
    {
        //
    }

    public function handle(TokenCalled $event)
    {
        // ambil semua call hari ini
        $calls = Call::with(['department', 'counter'])
            ->whereDate('called_date', Carbon::now())
            ->orderByDesc('id')
            ->take(20)
            ->get();

        // DISPLAY UTAMA
        $displayData = $this->prepareMainDisplay($calls);

        // DISPLAY TEMPLATE 1
        $textData = $this->prepareTemplate1Display($calls, 1); // 1 = template_id

        // simpan file JSON
        file_put_contents(
            base_path('assets/files/display'),
            json_encode($displayData, JSON_PRETTY_PRINT)
        );

        if (!empty($textData)) {
            file_put_contents(
                base_path('assets/files/display_template1'),
                json_encode($textData, JSON_PRETTY_PRINT)
            );
        }
    }

    /**
     * Prepare main display (7 slot, non-text)
     */
    protected function prepareMainDisplay($calls)
    {
        $displayData = [];
        $nonTextCalls = $calls->filter(function($call) {
                return $call->counter->call_type !== 'text';
            })->values();


        for ($i = 0; $i < 7; $i++) {
            $call = $nonTextCalls[$i] ?? null;

            $displayData[$i] = $call ? [
                'call_id'      => $call->id,
                'number'       => $call->number,
                'call_number'  => $call->number,
                'layanan'      => $call->department->letter,
                'namalayanan'  => $call->department->name,
                'counter'      => $call->counter->idcounter,
                'namacounter'  => $call->counter->name,
                'durasi'       => $call->counter->durasi,
                'call_type'    => $call->counter->call_type,
            ] : [
                'call_id'      => '-',
                'number'       => '-',
                'call_number'  => '-',
                'layanan'      => '-',
                'namalayanan'  => '-',
                'counter'      => '-',
                'namacounter'  => '-',
                'durasi'       => '-',
                'call_type'    => '-',
            ];
        }

        return $displayData;
    }

    /**
     * Prepare display template 1 (text only)
     */
    protected function prepareTemplate1Display($calls, $templateId)
    {
        $textData = [];

        $template = Template::find($templateId);
        if (!$template) return $textData;

        $departmentIds = is_array($template->department_ids)
            ? $template->department_ids
            : json_decode($template->department_ids, true);

        $counterIds = is_array($template->counter_ids)
            ? $template->counter_ids
            : json_decode($template->counter_ids, true);

        $textCalls = $calls->filter(function($call) use ($departmentIds, $counterIds) {
            return in_array($call->department_id, $departmentIds) &&
                in_array($call->counter_id, $counterIds);
        })->take(3)->values();

        foreach ($textCalls as $call) {
            $textData[] = [
                'call_id'      => $call->id,
                'number'       => $call->number,
                'call_number'  => $call->number,
                'layanan'      => $call->department->letter,
                'namalayanan'  => $call->department->name,
                'counter'      => $call->counter->idcounter,
                'namacounter'  => $call->counter->name,
                'durasi'       => $call->counter->durasi,
                'call_type'    => $call->counter->call_type,
                'dinamic_call' => $call->counter->dinamic_call,
            ];
        }

        return $textData;
    }
}
