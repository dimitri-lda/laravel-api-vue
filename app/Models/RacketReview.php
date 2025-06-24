<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RacketReview extends Model
{
    protected $fillable = [
        'tennis_racket_variant_id',
        'reviewer_id',
        'review_url',
        'Groundstrokes',
        'Volleys',
        'Serves',
        'Returns',
        'Power',
        'Control',
        'Maneuverability',
        'Stability',
        'Comfort',
        'TouchFeel',
        'Spin',
        'Slice',
        'Sexiness',
        'Forgiveness',
        'overall',
    ];

    public function variant(): BelongsTo
    {
        return $this->belongsTo(TennisRacketVariant::class, 'tennis_racket_variant_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(Reviewer::class);
    }
}
