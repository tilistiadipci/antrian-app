<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['language_id', 'name', 'bus_no', 'address', 'email', 'phone', 'location', 'notification', 'size', 'color', 'logo', 'video', 'video1', 'video2', 'video3', 'video4', 'lisensi', 'kode_aktivasi', 'over_time', 'missed_time', 'printer_type', 'ip_address', 'usb_port'];

    public function language()
	{
		return $this->belongsTo('App\Models\Language');
	}
}
 