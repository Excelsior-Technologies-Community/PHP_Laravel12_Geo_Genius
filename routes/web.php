<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\GeoController;
use App\Services\GeoService;
use App\Services\AnalyticsService;
use App\Models\GeoVisitLog;

Route::get('/', function () {
    return view('welcome');
})->middleware('track.geo');

Route::middleware(['track.geo', 'throttle:10,1'])->group(function () {

    Route::get('/geo-test', [GeoController::class, 'geoTestView'])->middleware('throttle:10,1');

    Route::get('/timezone-test', [GeoController::class, 'timezoneTestView'])->middleware('throttle:10,1');

    Route::get('/lang-test', [GeoController::class, 'langTestView'])->middleware('throttle:10,1');

    Route::get('/change-lang/{lang}', [GeoController::class, 'changeLanguage'])
        ->where('lang', 'en|bn')
        ->middleware('throttle:10,1');

    Route::get('/phone', [GeoController::class, 'phone']);

    Route::post('/phone', [GeoController::class, 'phoneSubmit'])->middleware('throttle:10,1');

    Route::get('/track-geo', [GeoController::class, 'trackGeo'])->middleware('throttle:5,1');

    Route::get('/geo-dashboard', [GeoController::class, 'geoDashboard']);

    Route::delete('/geo-delete/{id}', [GeoController::class, 'deleteLog'])
        ->name('geo.delete')
        ->middleware('throttle:10,1');

});
