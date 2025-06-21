<?php

use App\Http\Controllers\Api\V1\ListBrandsController;
use App\Http\Controllers\Api\V1\ListTennisRacketModelsController;
use App\Http\Controllers\ApiExampleController;
use Illuminate\Support\Facades\Route;

Route::get('/example', [ApiExampleController::class, 'index']);

Route::get('/v1/brands', ListBrandsController::class)
    ->name('api.v1.brands.list');

Route::get('/v1/racket_models', ListTennisRacketModelsController::class)
    ->name('api.v1.racket_models.list');
