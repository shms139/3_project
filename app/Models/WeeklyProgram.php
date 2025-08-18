<?php

namespace App\Models;

use App\Http\Controllers\DirectorController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeeklyProgram extends Model
{
    protected $guarded = [];

    public function director()
    {
        return $this->belongsTo(Director::class);
    }

    public function classes(): BelongsTo
    {
        return $this->belongsTo(TheClass::class);
    }

}
