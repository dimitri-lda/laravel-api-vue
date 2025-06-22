<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TennisRacketVariant extends Model
{
    public const IN_TO_CM = 2.54;

    protected $fillable = [
        'article_number', 'color', 'weight', 'head_size', 'balance', 'string_pattern',
        'stiffness', 'length', 'frame_profile', 'tennis_racket_model_id', 'year',
    ];

    public function model(): BelongsTo
    {
        return $this->belongsTo(TennisRacketModel::class, 'tennis_racket_model_id');
    }

    public static function getSquareCentimetersBySquareInches($sqIn): float
    {
        return round($sqIn * self::IN_TO_CM * self::IN_TO_CM);
    }
}
