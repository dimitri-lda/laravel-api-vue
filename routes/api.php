<?php

use App\Http\Controllers\Api\V1\ListFiltersController;
use App\Http\Controllers\Api\V1\ListTennisRacketModelsController;
use App\Http\Controllers\ApiExampleController;
use Illuminate\Support\Facades\Route;

Route::get('/example', [ApiExampleController::class, 'index']);

Route::get('/v1/racket_models', ListTennisRacketModelsController::class)
    ->name('api.v1.racket_models.list');

Route::prefix('v1')->group(function () {
    Route::get('/brands', [ListFiltersController::class, 'brands']);
    Route::get('/filters/head-sizes', [ListFiltersController::class, 'headSizes']);
    Route::get('/filters/balances', [ListFiltersController::class, 'balances']);
    Route::get('/filters/weights', [ListFiltersController::class, 'weights']);
    Route::get('/filters/string-patterns', [ListFiltersController::class, 'stringPatterns']);
    Route::get('/filters/frame-profiles', [ListFiltersController::class, 'frameProfiles']);
    Route::get('/filters/years', [ListFiltersController::class, 'years']);
});
