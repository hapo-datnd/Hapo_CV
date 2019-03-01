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
        $this->belongsTo(Cv::class);
    }

    public function school()
    {
        $this->belongsTo(School::class);
    }
}
