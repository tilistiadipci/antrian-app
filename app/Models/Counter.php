<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $fillable = ['name', 'idcounter', 'durasi', 'lainnya'];

    public function calls()
	{
		return $this->hasMany('App\Models\Call');
	}
	public function settings()
    {
        return $this->hasMany('App\Models\Setting');
    }
}
