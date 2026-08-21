<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GeoVisitLog;
use App\Models\User;

class GeoVisitLogSeeder extends Seeder
{
    public function run(): void
    {
        GeoVisitLog::factory()->count(20)->create();
    }
}
