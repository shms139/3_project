<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes_Ann extends Model
{
    protected $guarded = [];

    // علاقة الإعلان
    public function announcement()
    {
        return $this->belongsTo(Announcement::class, 'announcement_id');
    }

    // علاقة الصف
    public function theClass()
    {
        return $this->belongsTo(TheClass::class, 'the_class_id');
    }


}
