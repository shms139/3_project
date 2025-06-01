<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

}
