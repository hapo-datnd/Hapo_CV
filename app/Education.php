<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{

    protected $fillable = [
        'start_time', 'end_time','position','achievement',
    ];

    public function cv()
    {
        $this->belongsTo('App/Cv');
    }

    public function school()
    {
        $this->belongsTo('App/School');
    }
}
