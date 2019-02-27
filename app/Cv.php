<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{

    protected $fillable = [
        'first_name', 'last_name', 'date_of_birth','phone','email','facebook','skype','chat_work','address','image',
        'position','summary','status','image_mini','professional_skill_table','personal_skill_title',
        'work_experience_title','education_title',
    ];

    public function workExperience()
    {
        $this->hasMany('App/WorkExperience');
    }

    public function education()
    {
        $this->hasMany('App/Education');
    }

    public function portfolio()
    {
        $this->hasMany('App/Portfolio');
    }

    public function reference()
    {
        $this->hasMany('App/Reference');
    }

    public function skill()
    {
        $this->belongsToMany('App/Skill');
    }

    public function user()
    {
        $this->belongsTo('App/User');
    }
}
