<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\GeoVisitLog;
use Jenssegers\Agent\Agent;
use Devrabiul\LaravelGeoGenius\LaravelGeoGenius;

class TrackGeo
{
    protected $geo;

    public function __construct(LaravelGeoGenius $geo)
    {
        $this->geo = $geo;
    }

    public function handle(Request $request, Closure $next)
    {
        $skipPaths = ['api', 'up', '_ignition', 'livewire'];

        foreach ($skipPaths as $path) {
            if (str_starts_with($request->path(), $path)) {
                return $next($request);
            }
        }

        if (session()->has('geo_tracked')) {
            return $next($request);
        }

        $agent = new Agent();

        GeoVisitLog::create([
            'ip_address' => $this->geo->geo()->getClientIp(),
            'country' => $this->geo->geo()->getCountry(),
            'city' => $this->geo->geo()->getCity(),
            'timezone' => $this->geo->geo()->getTimezone(),
            'browser' => $agent->browser(),
            'platform' => $agent->platform(),
            'visited_at' => now(),
        ]);

        session()->put('geo_tracked', true);

        return $next($request);
    }
}
