<?php

namespace App\Services;

use App\Models\GeoVisitLog;
use Illuminate\Http\Request;

class AnalyticsService
{
    public function getTotalVisits()
    {
        return GeoVisitLog::count();
    }

    public function getUniqueCountries()
    {
        return GeoVisitLog::distinct('country')->count();
    }

    public function getUniqueCities()
    {
        return GeoVisitLog::distinct('city')->count();
    }

    public function getCountries()
    {
        return GeoVisitLog::select('country')
            ->distinct()
            ->pluck('country');
    }

    public function getFilteredLogs(Request $request)
    {
        $query = GeoVisitLog::query();

        if ($search = $request->search) {
            $query->where(function ($q) use ($search) {
                $q->where('country', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('browser', 'like', "%{$search}%")
                    ->orWhere('platform', 'like', "%{$search}%");
            });
        }

        if ($country = $request->country) {
            $query->where('country', $country);
        }

        return $query->latest()->paginate(4);
    }

    public function deleteLog($id)
    {
        return GeoVisitLog::findOrFail($id)->delete();
    }
}
