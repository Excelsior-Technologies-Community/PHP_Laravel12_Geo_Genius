<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GeoVisitLog extends Model
{
    use HasFactory;

    protected $fillable = [

        'ip_address',

        'country',

        'city',

        'timezone',

        'browser',

        'platform',

        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];
}