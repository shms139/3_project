<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(P_student::class,"p_student_id",'id');
    }
    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function director()
    {
        return $this->belongsTo(Director::class);
    }

}
