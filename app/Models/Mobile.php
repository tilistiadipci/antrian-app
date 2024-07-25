<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobile extends Model
{
    protected $fillable = ['sliderbg1', 'sliderbg2', 'sliderbg3', 'slider_jdl1', 'slider_jdl2', 'slider_jdl3', 'slider_des1', 'slider_des2', 'slider_des3', 'sdb2_jdl', 'sdb2_des', 'banner1', 'banner2'];

    public function language()
	{
		return $this->belongsTo('App\Models\Language');
	}
}
 