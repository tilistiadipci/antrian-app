<?php

namespace App\Listeners;

use App\Events\TokenCalled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Call;
use App\Models\Counter;
use Carbon\Carbon;

class UpdateDisplay
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(TokenCalled $event)
    {
        $calls = Call::with('department', 'counter')
                    ->where('called_date', Carbon::now()->format('Y-m-d'))
                    ->orderBy('calls.id', 'desc')
                    ->take(7)
                    ->get();

        $data = [];
        for ($i=0;$i<7;$i++) {
            $data[$i]['call_id'] = (isset($calls[$i]))?$calls[$i]->id:'-';
            $data[$i]['number'] = (isset($calls[$i]))?($calls[$i]->number):'-';
            $data[$i]['call_number'] = (isset($calls[$i]))?($calls[$i]->number):'-';
            $data[$i]['layanan'] = (isset($calls[$i]))?$calls[$i]->department->letter:'-';
            $data[$i]['namalayanan'] = (isset($calls[$i]))?$calls[$i]->department->name:'-';
			$data[$i]['counter'] = (isset($calls[$i]))?$calls[$i]->counter->idcounter:'-';
            $data[$i]['namacounter'] = (isset($calls[$i]))?$calls[$i]->counter->name:'-';
            $data[$i]['durasi'] = (isset($calls[$i]))?$calls[$i]->counter->durasi:'-';
        }

        file_put_contents(base_path('assets/files/display'), json_encode($data));
    }
}
