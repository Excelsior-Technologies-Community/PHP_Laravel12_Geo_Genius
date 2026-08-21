<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Total GeoVisitLog records: " . \App\Models\GeoVisitLog::count() . "\n";
$logs = \App\Models\GeoVisitLog::latest()->limit(5)->get();
foreach ($logs as $log) {
    echo "ID: {$log->id} | IP: {$log->ip_address} | Country: {$log->country} | City: {$log->city} | Visited: {$log->visited_at}\n";
}
