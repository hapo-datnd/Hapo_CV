<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    use Notifiable;

    const ADMIN = 2;
    const SUPER_ADMIN = 1;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password','type',
    ];

    protected $hidden = [
        'password','remember_token',
    ];
}
