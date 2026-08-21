<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

// Simulate changing language to Bengali
Session::put('lang', 'bn');
App::setLocale('bn');

echo "Locale set to: " . App::getLocale() . "\n";
echo "Translation test: " . __('messages.welcome_message') . "\n";
