<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $guarded = [];

    public function director(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Director::class);
    }

    public function the_class()
    {
        return $this->belongsToMany(TheClass::class,"the_class_anns",'announcement_id','the_class_id');
    }   //->has many or has one can go to screenshoot to learn that



}
