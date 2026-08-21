<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Geo Genius - Laravel 12</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }
        .hero-card {
            background: white;
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            text-align: center;
            max-width: 700px;
            width: 90%;
        }
        .hero-title {
            font-size: 48px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 10px;
        }
        .hero-subtitle {
            font-size: 18px;
            color: #6b7280;
            margin-bottom: 30px;
        }
        .nav-btn {
            display: inline-block;
            margin: 8px;
            padding: 12px 28px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        .nav-btn-primary {
            background: #4f46e5;
            color: white;
        }
        .nav-btn-primary:hover {
            background: #4338ca;
            color: white;
            transform: translateY(-2px);
        }
        .nav-btn-secondary {
            background: #f3f4f6;
            color: #374151;
        }
        .nav-btn-secondary:hover {
            background: #e5e7eb;
            color: #111827;
            transform: translateY(-2px);
        }
        .lang-switch {
            margin-top: 25px;
        }
        .lang-switch a {
            margin: 0 5px;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .lang-switch a.active {
            background: #4f46e5;
            color: white;
        }
        .lang-switch a:not(.active) {
            background: #f3f4f6;
            color: #374151;
        }
        .lang-switch a:not(.active):hover {
            background: #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="hero-card">
        <div class="hero-title">🌍 Geo Genius</div>
        <p class="hero-subtitle">@lang('messages.welcome_message')</p>

        <div class="mb-4">
            <a href="{{ url('/geo-test') }}" class="nav-btn nav-btn-primary">@lang('messages.nav_geo_test')</a>
            <a href="{{ url('/timezone-test') }}" class="nav-btn nav-btn-primary">@lang('messages.nav_timezone_test')</a>
            <a href="{{ url('/lang-test') }}" class="nav-btn nav-btn-secondary">@lang('messages.nav_lang_test')</a>
            <a href="{{ url('/phone') }}" class="nav-btn nav-btn-secondary">@lang('messages.nav_phone')</a>
            <a href="{{ url('/geo-dashboard') }}" class="nav-btn nav-btn-primary">@lang('messages.nav_dashboard')</a>
        </div>

        <div class="lang-switch">
            <strong>@lang('messages.welcome_message'): </strong><br><br>
            <a href="{{ url('/change-lang/en') }}" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">English</a>
            <a href="{{ url('/change-lang/bn') }}" class="{{ app()->getLocale() == 'bn' ? 'active' : '' }}">বাংলা</a>
        </div>
    </div>
</body>
</html>
