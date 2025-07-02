<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    public function sales()
    {
        return $this->belongsTo('App\Sales');
    }
}
