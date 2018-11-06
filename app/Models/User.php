<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //'name', 'email', 'password',
        'name',
        'email',
        'phone',
        'password',
        'provider',
        'provider_id',
        'avatar',
        'role_id',
        'notifyDetectedFault',
        'notifyFaultFix'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
       // return $this->hasOne(Models\Role::class,'id','role_id');
    }

}
