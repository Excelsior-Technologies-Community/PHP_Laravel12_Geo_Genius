<?php

use Illuminate\Support\Facades\Route;
use Devrabiul\LaravelGeoGenius\Services\TimezoneService;
use function Devrabiul\LaravelGeoGenius\geniusTrans;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/geo-test', function () {
    return [
        'ip'        => laravelGeoGenius()->geo()->getClientIp(),
        'country'   => laravelGeoGenius()->geo()->getCountry(),
        'timezone'  => laravelGeoGenius()->geo()->getTimezone(),
        'latitude'  => laravelGeoGenius()->geo()->getLatitude(),
        'longitude' => laravelGeoGenius()->geo()->getLongitude(),
    ];
});

Route::get('/timezone-test', function () {
    $tz = new TimezoneService();

    return [
        'user_timezone' => $tz->getUserTimezone(),
        'converted_time' => $tz->convertToUserTimezone(now()),
    ];
});

Route::get('/lang-test', function () {
    return __('welcome_message');
});

Route::get('/change-lang/{lang}', function ($lang) {
    laravelGeoGenius()->language()->changeUserLanguage($lang);
    return redirect()->back();
});

Route::get('/phone', function () {
    return view('phone');
});
