<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/show-api', function () {
    return view('show-api');
});

Route::view('/racket-list', 'racket-list')->name('racket.list');
