<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TennisRacketModel extends Model
{
    protected $fillable = ['name', 'brand_id', 'logo_url'];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(TennisRacketVariant::class, 'tennis_racket_model_id');
    }
}
