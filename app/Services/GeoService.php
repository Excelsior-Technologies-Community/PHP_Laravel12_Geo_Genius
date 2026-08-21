<?php

namespace App\Services;

use Devrabiul\LaravelGeoGenius\LaravelGeoGenius;
use Devrabiul\LaravelGeoGenius\Services\TimezoneService;
use Jenssegers\Agent\Agent;

class GeoService
{
    protected $geo;

    public function __construct(LaravelGeoGenius $geo)
    {
        $this->geo = $geo;
    }

    public function getClientIp()
    {
        return $this->geo->geo()->getClientIp();
    }

    public function getCountry()
    {
        return $this->geo->geo()->getCountry();
    }

    public function getCity()
    {
        return $this->geo->geo()->getCity();
    }

    public function getTimezone()
    {
        return $this->geo->geo()->getTimezone();
    }

    public function getLatitude()
    {
        return $this->geo->geo()->getLatitude();
    }

    public function getLongitude()
    {
        return $this->geo->geo()->getLongitude();
    }

    public function getUserTimezone()
    {
        $tz = new TimezoneService();

        return $tz->getUserTimezone();
    }

    public function convertToUserTimezone($datetime)
    {
        $tz = new TimezoneService();

        return $tz->convertToUserTimezone($datetime);
    }

    public function changeUserLanguage($lang)
    {
        $this->geo->language()->changeUserLanguage($lang);
    }

    public function getBrowserPlatform()
    {
        $agent = new Agent();

        return [
            'browser' => $agent->browser(),
            'platform' => $agent->platform(),
        ];
    }
}
