<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mark extends Model
{
    protected $guarded = [];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function director(): BelongsTo
    {
        return $this->belongsTo(Director::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(TheClass::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(subject::class);
    }

}
