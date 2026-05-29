<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoVisitLog extends Model
{
    protected $fillable = [

        'ip_address',

        'country',

        'city',

        'timezone',

        'browser',

        'platform',

        'visited_at',
    ];
}