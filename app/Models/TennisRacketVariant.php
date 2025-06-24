<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TennisRacketVariant extends Model
{
    public const IN_TO_CM = 2.54;

    protected $fillable = [
        'article_number', 'color', 'weight', 'head_size', 'balance', 'string_pattern',
        'stiffness', 'length', 'frame_profile', 'tennis_racket_model_id', 'year', 'logo_url',
    ];

    public function model(): BelongsTo
    {
        return $this->belongsTo(TennisRacketModel::class, 'tennis_racket_model_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(RacketReview::class, 'tennis_racket_variant_id');
    }

    public static function getSquareCentimetersBySquareInches($sqIn): float
    {
        return round($sqIn * self::IN_TO_CM * self::IN_TO_CM);
    }
}
