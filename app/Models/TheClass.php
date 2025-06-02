<?php

namespace App\Models;

use App\Http\Controllers\DirectorController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TheClass extends Model
{
    protected $guarded = [];

    public function announcements()
    {
        return $this->belongsToMany(Announcement::class,"the_class_anns",'the_class_id','announcement_id');
    }

    public function weekly_program(): HasOne
    {
        return $this->hasOne(DirectorController::class);
    }

    public function marks(): HasMany
    {
        return $this->hasMany(Mark::class);
    }

}
