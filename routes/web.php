<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/geo-test', [GeoController::class, 'geoTest']);

Route::get('/timezone-test', [GeoController::class, 'timezoneTest']);

Route::get('/lang-test', [GeoController::class, 'langTest']);

Route::get('/change-lang/{lang}', [GeoController::class, 'changeLanguage']);

Route::get('/phone', [GeoController::class, 'phone']);

Route::get('/track-geo', [GeoController::class, 'trackGeo']);

Route::get('/geo-dashboard', [GeoController::class, 'geoDashboard']);

Route::delete('/geo-delete/{id}', [GeoController::class, 'deleteLog'])
    ->name('geo.delete');