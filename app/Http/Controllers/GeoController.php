<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeoService;
use App\Services\AnalyticsService;
use Jenssegers\Agent\Agent;

class GeoController extends Controller
{
    protected $geoService;

    protected $analyticsService;

    public function __construct(GeoService $geoService, AnalyticsService $analyticsService)
    {
        $this->geoService = $geoService;
        $this->analyticsService = $analyticsService;
    }

    public function geoTest()
    {
        return response()->json([
            'ip' => $this->geoService->getClientIp(),
            'country' => $this->geoService->getCountry(),
            'city' => $this->geoService->getCity(),
            'timezone' => $this->geoService->getTimezone(),
            'latitude' => $this->geoService->getLatitude(),
            'longitude' => $this->geoService->getLongitude(),
        ]);
    }

    public function geoTestView()
    {
        $data = [
            'ip' => $this->geoService->getClientIp(),
            'country' => $this->geoService->getCountry(),
            'city' => $this->geoService->getCity(),
            'timezone' => $this->geoService->getTimezone(),
            'latitude' => $this->geoService->getLatitude(),
            'longitude' => $this->geoService->getLongitude(),
        ];

        return view('geo-test', compact('data'));
    }

    public function timezoneTest()
    {
        return response()->json([
            'user_timezone' => $this->geoService->getUserTimezone(),
            'converted_time' => $this->geoService->convertToUserTimezone(now()),
        ]);
    }

    public function timezoneTestView()
    {
        $data = [
            'user_timezone' => $this->geoService->getUserTimezone(),
            'converted_time' => $this->geoService->convertToUserTimezone(now()),
        ];

        return view('timezone-test', compact('data'));
    }

    public function langTest()
    {
        return response()->json([
            'message' => __('messages.welcome_message'),
        ]);
    }

    public function langTestView()
    {
        $message = __('messages.welcome_message');

        return view('lang-test', compact('message'));
    }

    public function changeLanguage($lang)
    {
        $validLangs = ['en', 'bn'];

        if (!in_array($lang, $validLangs)) {
            return redirect()->back()->with('error', __('messages.invalid_language'));
        }

        $this->geoService->changeUserLanguage($lang);

        \Illuminate\Support\Facades\App::setLocale($lang);

        session(['lang' => $lang]);

        return redirect()->back()->with('success', __('messages.language_changed'));
    }

    public function phone()
    {
        return view('phone');
    }

    public function phoneSubmit(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
        ]);

        return back()->with('success', 'Phone number received: ' . $request->phone);
    }

    public function trackGeo()
    {
        if (session()->has('geo_tracked')) {
            return redirect('/geo-dashboard')->with('success', 'Geo already tracked this session.');
        }

        $geoData = $this->geoService->getBrowserPlatform();

        \App\Models\GeoVisitLog::create([
            'ip_address' => $this->geoService->getClientIp(),
            'country' => $this->geoService->getCountry(),
            'city' => $this->geoService->getCity(),
            'timezone' => $this->geoService->getTimezone(),
            'browser' => $geoData['browser'],
            'platform' => $geoData['platform'],
            'visited_at' => now(),
        ]);

        session()->put('geo_tracked', true);

        return redirect('/geo-dashboard')->with('success', 'Geo tracked successfully.');
    }

    public function geoDashboard(Request $request)
    {
        $totalVisits = $this->analyticsService->getTotalVisits();

        $uniqueCountries = $this->analyticsService->getUniqueCountries();

        $uniqueCities = $this->analyticsService->getUniqueCities();

        $countries = $this->analyticsService->getCountries();

        $latestLogs = $this->analyticsService->getFilteredLogs($request);

        $chartData = $this->getChartData();

        return view('geo-dashboard', compact(
            'totalVisits',
            'uniqueCountries',
            'uniqueCities',
            'latestLogs',
            'countries',
            'chartData'
        ));
    }

    protected function getChartData()
    {
        $logs = \App\Models\GeoVisitLog::selectRaw('DATE(visited_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return [
            'labels' => $logs->pluck('date')->toArray(),
            'data' => $logs->pluck('count')->toArray(),
        ];
    }

    public function deleteLog($id)
    {
        $this->analyticsService->deleteLog($id);

        return redirect()->back()->with('success', 'Geo Log Deleted Successfully');
    }
}
