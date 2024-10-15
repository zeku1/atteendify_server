<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('code');
});

Route::get('/thank-you', function () {
    return view('TYpage');
});
