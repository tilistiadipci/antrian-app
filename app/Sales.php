<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = [
        'name', 
        'email', 
        'no_hp', 
        'is_sales_assigned'
    ];
}
