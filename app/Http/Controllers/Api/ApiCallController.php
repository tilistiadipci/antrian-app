<?php

namespace App\Http\Controllers\Api;

use App\Events\TokenCalled;
use App\Events\TokenIssued;
use App\Http\Controllers\Controller;
use App\Models\Call;
use App\Models\Counter;
use App\Models\Department;
use App\Models\Queue;
use App\Models\Setting;
use App\Models\User;
use App\Repositories\CallRepository;
use App\Repositories\AddToQueueRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiCallController extends Controller
{
    protected $calls;
    protected $add_to_queues;

    public function __construct(CallRepository $calls, AddToQueueRepository $add_to_queues)
    {
        $this->calls = $calls;
        $this->add_to_queues = $add_to_queues;
    }

    public function getCounters(Request $request)
    {
        $counters = Counter::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Daftar loket berhasil diambil',
            'data' => $counters,
        ]);
    }

    public function getDepartments(Request $request)
    {
        $departments = Department::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Daftar departemen berhasil diambil',
            'data' => $departments,
        ]);
    }

    public function getAntrian(Request $request)
    {
        $department = Department::findOrFail($request->layanan_id ?? 1);

        $last_token = $this->add_to_queues->getLastToken($department);

        if ($last_token) {
            $queue = $department->queues()->create([
                'number' => ((int)$last_token->number) + 1,
                'called' => 0,
                'id_member' => 0,
            ]);
        } else {
            $queue = $department->queues()->create([
                'number' => $department->start,
                'called' => 0,
                'id_member' => 0,
            ]);
        }

        $total = $this->add_to_queues->getCustomersWaiting($department);
        $number = ($department->letter != '') ? $department->letter . '-' . $queue->number : $queue->number;
        $settings = Setting::first();

        event(new \App\Events\TokenIssued());

        return response()->json([
            'status' => 'success',
            'message' => 'Token berhasil dibuat',
            'data' => [
                'queue_id' => $queue->id,
                'number' => $queue->number,
                'call_number' => $number,
                'layanan_id' => $department->id,
                'department' => $department->name,
                'total_waiting' => $total,
            ],
        ]);
    }

    public function getQueueList(Request $request)
    {
        $query = Queue::with('department')
            ->where('called', 0)
            ->whereBetween('created_at', [
                Carbon::now()->format('Y-m-d 00:00:00'),
                Carbon::now()->format('Y-m-d 23:59:59'),
            ]);

        if ($request->has('layanan_id') && $request->get('layanan_id') !== '') {
            $query->where('department_id', $request->get('layanan_id'));
        }

        $queues = $query->orderBy('created_at', 'asc')
            ->take(5)
            ->get()
            ->map(function ($queue) {
                $letter = $queue->department->letter;

                return [
                    'queue_id' => $queue->id,
                    'number' => $queue->number,
                    'call_number' => $letter !== '' ? $letter.'-'.$queue->number : $queue->number,
                    'layanan_id' => $queue->department->id,
                    'department' => $queue->department->name,
                    'created_at' => $queue->created_at->format('d-m-Y H:i'),
                ];
            })
            ->values();

        return response()->json([
            'status' => 'success',
            'message' => $queues->count() > 0 ? 'Daftar antrean berhasil diambil' : 'Tidak ada antrean',
            'data' => $queues,
        ]);
    }

    public function call(Request $request)
    {
        $user = User::findOrFail($request->get('user_id', 1));
        $counter = Counter::findOrFail($request->get('counter_id', 1));
        $department = Department::findOrFail($request->get('layanan_id', 1));

        $queue = $this->calls->getNextToken($department);

        if ($queue === null) {
            return response()->json([
                'status' => 'empty',
                'message' => 'Tidak ada antrean di loket',
                'data' => null,
            ], 404);
        }

        $queue->call()->create([
            'department_id' => $department->id,
            'counter_id' => $counter->id,
            'user_id' => $user->id,
            'number' => $queue->number,
            'called_date' => Carbon::now()->format('Y-m-d'),
        ]);

        $queue->called = 1;
        $queue->save();

        event(new TokenIssued());
        event(new TokenCalled());

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil memanggil antrean',
            'data' => [
                'queue_id' => $queue->id,
                'number' => $queue->number,
                'call_number' => $department->letter . '-' . $queue->number,
                'department' => $department->name,
                'counter' => $counter->name,
                'user' => $user->name,
            ],
        ]);
    }

    public function recall(Request $request)
    {
        $call = Call::where('queue_id', $request->queue_id)->first();
        if (!$call) {
            return response()->json([
                'status' => 'error',
                'message' => 'Antrean tidak ditemukan',
                'data' => null,
            ], 404);
        }
        $newCall = $call->replicate();
        $newCall->save();

        $call->delete();

        event(new TokenIssued());
        event(new TokenCalled());

        $data = $newCall->load('department');

        return response()->json([
            'status' => 'success',
            'message' => 'Memanggil ulang',
            'data' => $data,
            'call_number' => $data->department->letter . '-' . $data->number,
        ]);
    }
}
