<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Department;
use App\Models\Counter;
use App\Models\Setting;

class TestimoniRepository
{
    public function getAll()
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
    
    public function getSettings()
    {
        return Setting::first();
    }

}
