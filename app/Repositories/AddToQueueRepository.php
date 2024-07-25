<?php

namespace App\Repositories;

use App\Models\Department;
use Carbon\Carbon;
use App\Models\Queue;
use App\Models\Counter;
use App\Models\Call;


class AddToQueueRepository
{
    public function getDepartments()
    {
        return Department::all();
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
                    ->first();
                    
    }
}
