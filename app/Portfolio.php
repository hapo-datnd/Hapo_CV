<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{

    protected $fillable = [
        'start_time','name','end_time', 'customer','position','description','team_size','responsibilities',
        'technologies','is_feature',
    ];

    public function cv()
    {
        $this->belongsTo(Cv::class);
    }
}
