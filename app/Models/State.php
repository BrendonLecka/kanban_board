<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function boards(): BelongsTo
    {
        return $this->belongsTo(Board::class);
    }

    public function issues(): HasMany
    {
        return $this->hasMany(Issue::class);
    }
}
