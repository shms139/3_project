<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(P_student::class,"p_student_id",'id');
    }
    public function marks(): HasMany
    {
        return $this->hasMany(Mark::class);
    }

    public function director(): BelongsTo
    {
        return $this->belongsTo(Director::class);
    }

    public function check(): HasMany
    {
        return $this->hasMany(Check::class);
    }



}
