<?php

namespace App\Repositories;

use App\Models\Counter;
use App\Models\Setting;

class CounterRepository
{
    public function getAll()
    {
        return Counter::all();
    }

    public function getSettings()
    {
        return Setting::first();
    }
}
