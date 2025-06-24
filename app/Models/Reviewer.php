<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reviewer extends Model
{
    protected $fillable = [
        'name',
        'organization',
    ];

    public function racketReviews(): HasMany
    {
        return $this->hasMany(RacketReview::class);
    }
}
