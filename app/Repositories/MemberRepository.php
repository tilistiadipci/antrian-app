<?php

namespace App\Repositories;

use App\Models\Member;
use App\Models\Department;
use App\Models\Counter;
use App\Models\Setting;

class MemberRepository
{
    public function getAll()
    {
        return Member::all();
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
