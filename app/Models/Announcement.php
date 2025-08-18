<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    protected $guarded = [];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function the_class()
    {
        return $this->belongsToMany(TheClass::class,"the_class_anns",'announcement_id','the_class_id');
    }   //->has many or has one can go to screenshoot to learn that



}
