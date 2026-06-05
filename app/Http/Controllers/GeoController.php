<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeoVisitLog;
use Jenssegers\Agent\Agent;
use Devrabiul\LaravelGeoGenius\Services\TimezoneService;

class GeoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | GEO TEST
    |--------------------------------------------------------------------------
    */

    public function geoTest()
    {
        return response()->json([

            'ip' => laravelGeoGenius()->geo()->getClientIp(),

            'country' => laravelGeoGenius()->geo()->getCountry(),

            'city' => laravelGeoGenius()->geo()->getCity(),

            'timezone' => laravelGeoGenius()->geo()->getTimezone(),

            'latitude' => laravelGeoGenius()->geo()->getLatitude(),

            'longitude' => laravelGeoGenius()->geo()->getLongitude(),

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | TIMEZONE TEST
    |--------------------------------------------------------------------------
    */

    public function timezoneTest()
    {
        $tz = new TimezoneService();

        return response()->json([

            'user_timezone' => $tz->getUserTimezone(),

            'converted_time' => $tz->convertToUserTimezone(now()),

        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | LANGUAGE TEST
    |--------------------------------------------------------------------------
    */

    public function langTest()
    {
        return __('messages.welcome_message');
    }

    /*
    |--------------------------------------------------------------------------
    | CHANGE LANGUAGE
    |--------------------------------------------------------------------------
    */

    public function changeLanguage($lang)
    {
        laravelGeoGenius()->language()->changeUserLanguage($lang);

        return redirect()->back();
    }

    /*
    |--------------------------------------------------------------------------
    | PHONE PAGE
    |--------------------------------------------------------------------------
    */

    public function phone()
    {
        return view('phone');
    }

    /*
    |--------------------------------------------------------------------------
    | TRACK GEO VISITOR
    |--------------------------------------------------------------------------
    */

    public function trackGeo()
    {
        $agent = new Agent();

        GeoVisitLog::create([

            'ip_address' => laravelGeoGenius()->geo()->getClientIp(),

            'country' => laravelGeoGenius()->geo()->getCountry(),

            'city' => laravelGeoGenius()->geo()->getCity(),

            'timezone' => laravelGeoGenius()->geo()->getTimezone(),

            'browser' => $agent->browser(),

            'platform' => $agent->platform(),

            'visited_at' => now(),
        ]);

        return redirect('/geo-dashboard');
    }

    /*
    |--------------------------------------------------------------------------
    | GEO ANALYTICS DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function geoDashboard(Request $request)
    {
        $totalVisits = GeoVisitLog::count();

        $uniqueCountries = GeoVisitLog::distinct('country')->count();

        $uniqueCities = GeoVisitLog::distinct('city')->count();

        $query = GeoVisitLog::query();

        // Search
        if ($request->search) {
            $query->where('country', 'like', '%' . $request->search . '%')
                ->orWhere('city', 'like', '%' . $request->search . '%')
                ->orWhere('browser', 'like', '%' . $request->search . '%')
                ->orWhere('platform', 'like', '%' . $request->search . '%');
        }

        // Country Filter
        if ($request->country) {
            $query->where('country', $request->country);
        }

        $countries = GeoVisitLog::select('country')
            ->distinct()
            ->pluck('country');

        $latestLogs = $query->oldest()->paginate(4);

        return view('geo-dashboard', compact(
            'totalVisits',
            'uniqueCountries',
            'uniqueCities',
            'latestLogs',
            'countries'
        ));
    }

    public function deleteLog($id)
    {
        GeoVisitLog::findOrFail($id)->delete();

        return redirect()->back()->with(
            'success',
            'Geo Log Deleted Successfully'
        );
    }
}