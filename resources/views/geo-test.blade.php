<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.nav_geo_test') - Geo Genius</title>
    <style>
        body {
            background: #f4f7fc;
            font-family: Arial, sans-serif;
            padding: 40px 20px;
        }
        .data-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }
        .data-label {
            font-size: 14px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }
        .data-value {
            font-size: 22px;
            font-weight: 700;
            color: #111827;
            margin-top: 5px;
        }
        .back-btn {
            display: inline-block;
            margin-bottom: 25px;
            text-decoration: none;
            color: #4f46e5;
            font-weight: 600;
        }
        .back-btn:hover {
            color: #4338ca;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ url('/') }}" class="back-btn">← @lang('messages.nav_home')</a>
        <h2 class="mb-4">🌍 @lang('messages.nav_geo_test')</h2>

        <div class="row">
            <div class="col-md-6">
                <div class="data-card">
                    <div class="data-label">IP Address</div>
                                <div class="data-value">{{ $data['ip'] ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="data-card">
                    <div class="data-label">Country</div>
                                <div class="data-value">{{ $data['country'] ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="data-card">
                    <div class="data-label">City</div>
                                <div class="data-value">{{ $data['city'] ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="data-card">
                    <div class="data-label">Timezone</div>
                                <div class="data-value">{{ $data['timezone'] ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="data-card">
                    <div class="data-label">Latitude</div>
                                <div class="data-value">{{ $data['latitude'] ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="data-card">
                    <div class="data-label">Longitude</div>
                                <div class="data-value">{{ $data['longitude'] ?? 'N/A' }}</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
