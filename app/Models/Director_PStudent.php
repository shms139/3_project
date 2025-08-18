<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Director_PStudent extends Model
{
    protected $guarded = [];

    public function director()
    {
        return $this->belongsTo(Director::class, 'director_id');
    }

    // علاقة الصف
    public function parentStudent()
    {
        return $this->belongsTo(P_student::class, 'p_student_id');
    }

}
