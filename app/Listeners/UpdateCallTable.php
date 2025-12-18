<?php

namespace App\Listeners;

use App\Events\TokenIssued;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Queue;
use Carbon\Carbon;

class UpdateCallTable
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

    public function handle(TokenIssued $event)
    {
        $queues = Queue::with('department')
                    ->whereBetween('queues.created_at',[Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')])
                    ->orderBy('queues.created_at', 'desc')
                    ->get();

        $queue_array = [];
        foreach ($queues as $key => $queue) {
            if($queue->called) {
                $counter = $queue->call->counter->name.'' .$queue->call->counter->idcounter;
                
                if ($queue->call->counter->call_type === 'text') {
                    $counter = str_replace('.mp3', '', $queue->call->counter->dinamic_call); 
                }

                $queue_array[$key]['id'] = ((int)$key)+1;
                $queue_array[$key]['department'] = $queue->department->name;
                $queue_array[$key]['department_id'] = $queue->department->id;
                $queue_array[$key]['number'] = ($queue->department->letter!='')?$queue->department->letter.'-'.$queue->number:$queue->number;
                $queue_array[$key]['called'] = 'Ya';
                $queue_array[$key]['counter'] = $counter;
                $queue_array[$key]['recall'] = '<button class="btn waves-effect waves-light center btn-recall" type="button" style="background:#FF5733;border-radius: 20px 20px 20px 20px;" onclick="recall('.$queue->call->id.')">
                                        Recall<i class="mdi-navigation-refresh right"></i>
                                    </button>';
            } else {
                $queue_array[$key]['id'] = ((int)$key)+1;
                $queue_array[$key]['department'] = $queue->department->name;
                $queue_array[$key]['department_id'] = $queue->department->id;
                $queue_array[$key]['number'] = ($queue->department->letter!='')?$queue->department->letter.'-'.$queue->number:$queue->number;
                $queue_array[$key]['called'] = 'Tidak';
                $queue_array[$key]['counter'] = '-';
                $queue_array[$key]['recall'] = '<button class="btn-floating disabled" disabled> <i class="mdi-navigation-refresh"></i></button>';
            }
        }

        $data = array('data' => $queue_array);

        file_put_contents(base_path('assets/files/call'), json_encode($data, JSON_PRETTY_PRINT));
    }
}
