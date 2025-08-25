<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Director extends Model
{
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parentStudents(): BelongsToMany
    {
        return $this->belongsToMany(P_student::class, 'director_p_student');
    }

    public function weeklyPrograms(): HasMany
    {
        return $this->hasMany(WeeklyProgram::class);
    }

    public function marks(): HasMany
    {
        return $this->hasMany(Mark::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function Chat_parentStudents(): BelongsToMany
    {
        return $this->belongsToMany(P_student::class);
    }

    public function check(): HasMany
    {
        return $this->hasMany(Check::class);
    }


}
