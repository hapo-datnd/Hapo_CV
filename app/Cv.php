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

    public function workExperiences()
    {
        $this->hasMany(WorkExperience::class);
    }

    public function education()
    {
        $this->hasMany(Education::class);
    }

    public function portfolios()
    {
        $this->hasMany(Portfolio::class);
    }

    public function references()
    {
        $this->hasMany(Reference::class);
    }

    public function skill()
    {
        $this->belongsToMany(Skill::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
