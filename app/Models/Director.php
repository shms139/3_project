<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Director extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parentStudents()
    {
        return $this->belongsToMany(P_student::class, 'director_p_student');
    }

    public function weeklyPrograms()
    {
        return $this->hasMany(WeeklyProgram::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function Chat_parentStudents()
    {
        return $this->belongsToMany(P_student::class);
    }


}
