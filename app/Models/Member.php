<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guard = 'members';
    protected $fillable = ['name', 'username', 'email', 'role', 'password', 'alamat', 'telp'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function calls()
	{
		return $this->hasMany('App\Models\Call');
	}

	public function getRoleTextAttribute($value)
	{
		if($this->attributes['role']=='U') return trans('messages.mainapp.role.Administrator');

		return trans('messages.mainapp.role.Staff');
	}

    public function getIsAdminAttribute($value)
	{
		if($this->attributes['role']=='U') return true;

        return false;
	}

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function counter()
    {
        return $this->belongsTo('App\Models\Counter');
    }

    public function settings()
    {
        return $this->belongsTo('App\Models\Setting');
    }
    public function channels()
    {
        return $this->belongsTo('App\Models\Channel');
    }
}
