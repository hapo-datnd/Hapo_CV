<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $fillable = [
        'name', 'adress', 'is_verified',
    ];

    public function workExperience()
    {
        $this->hasMany('App/WorkExperience');
    }
}
