<?php

namespace App\Repositories;

use App\Models\Language;
use App\Models\Mobile;


class MobilesRepository
{

    public function getLanguages()
    {
        return Language::all();
    }

    public function getMobiles()
    {
        return Mobile::first();
    }
}
