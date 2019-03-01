<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{

    protected $fillable = [
        'start_time', 'end_time','position','work_content',
    ];

    public function cv()
    {
        $this->belongsTo(Cv::class);
    }

    public function company()
    {
        $this->belongsTo(Company::class);
    }
}
