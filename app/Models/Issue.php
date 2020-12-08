<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Issue extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function states(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
