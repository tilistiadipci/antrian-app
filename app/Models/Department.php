<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'letter', 'start', 'limit_antrian'];

    public function queues()
	{
		return $this->hasMany('App\Models\Queue');
	}

    public function calls()
	{
		return $this->hasMany('App\Models\Call');
	}
	public function settings()
    {
        return $this->hasMany('App\Models\Setting');
    }
}
