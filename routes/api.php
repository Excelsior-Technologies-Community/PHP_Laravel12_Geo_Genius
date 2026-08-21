<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeoController;

Route::middleware('throttle:10,1')->group(function () {

    Route::get('/geo', [GeoController::class, 'geoTest']);

    Route::get('/timezone', [GeoController::class, 'timezoneTest']);

    Route::get('/language', [GeoController::class, 'langTest']);

});
