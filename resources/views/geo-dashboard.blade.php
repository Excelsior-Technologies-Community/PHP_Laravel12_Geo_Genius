<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.dashboard_title')</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    <style>
        body {
            background: #f4f7fc;
            font-family: Arial, sans-serif;
        }

        .dashboard-container {
            padding: 40px 20px;
        }

        .dashboard-title {
            font-size: 32px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 30px;
        }

        .stats-card {
            border: none;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: 0.3s ease;
            background: white;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-number {
            font-size: 38px;
            font-weight: bold;
            color: #4f46e5;
        }

        .stats-text {
            font-size: 18px;
            color: #6b7280;
        }

        .table-container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .table thead {
            background: #111827;
            color: white;
        }

        .table th {
            padding: 16px;
            font-size: 14px;
            white-space: nowrap;
            border: none;
        }

        .table td {
            padding: 16px;
            vertical-align: middle;
            font-size: 14px;
            color: #374151;
            border-color: #f1f5f9;
        }

        .table tbody tr:hover {
            background: #f8fafc;
        }

        .badge-browser {
            background: #e0e7ff;
            color: #3730a3;
            padding: 8px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-platform {
            background: #dcfce7;
            color: #166534;
            padding: 8px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
        }

        .chart-container {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            height: 350px;
        }

        .pagination-wrapper {
            margin-top: 25px;
        }

        .pagination-wrapper nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            flex-wrap: wrap;
            gap: 15px;
        }

        .pagination-wrapper svg {
            width: 18px;
            height: 18px;
        }

        .pagination {
            margin: 0;
        }

        .pagination .page-link {
            border: none;
            margin: 0 4px;
            border-radius: 10px !important;
            min-width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #111827;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            transition: 0.3s ease;
        }

        .pagination .page-link:hover {
            background: #4f46e5;
            color: white;
        }

        .pagination .page-item.active .page-link {
            background: #4f46e5;
            color: white;
            border: none;
        }

        .pagination .page-item.disabled .page-link {
            background: #f3f4f6;
            color: #9ca3af;
        }

        @media(max-width:768px) {

            .dashboard-title {
                font-size: 26px;
            }

            .stats-number {
                font-size: 30px;
            }

            .table th,
            .table td {
                font-size: 13px;
                padding: 12px;
            }

            .pagination-wrapper nav {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="container dashboard-container">
        <h1 class="dashboard-title">
            🌍 @lang('messages.dashboard_title')
        </h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="chart-container">
            <h5 class="mb-3">@lang('messages.total_visits') @lang('messages.dashboard_title')</h5>
            <canvas id="visitsChart" height="100"></canvas>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form method="GET" action="{{ url('/geo-dashboard') }}">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <input type="text" name="search" class="form-control"
                                placeholder="@lang('messages.search_placeholder')"
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="country" class="form-select">
                                <option value="">@lang('messages.all_countries')</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country }}" {{ request('country') == $country ? 'selected' : '' }}>
                                        {{ $country }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">
                                @lang('messages.search_button')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="stats-number">{{ $totalVisits }}</div>
                    <div class="stats-text">@lang('messages.total_visits')</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="stats-number">{{ $uniqueCountries }}</div>
                    <div class="stats-text">@lang('messages.unique_countries')</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="stats-number">{{ $uniqueCities }}</div>
                    <div class="stats-text">@lang('messages.unique_cities')</div>
                </div>
            </div>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>IP Address</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Timezone</th>
                            <th>Browser</th>
                            <th>Platform</th>
                            <th>Visited At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestLogs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->ip_address }}</td>
                                <td>{{ $log->country }}</td>
                                <td>{{ $log->city }}</td>
                                <td>{{ $log->timezone }}</td>
                                <td><span class="badge-browser">{{ $log->browser }}</span></td>
                                <td><span class="badge-platform">{{ $log->platform }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($log->visited_at)->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <form action="{{ route('geo.delete', $log->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('@lang('messages.delete_confirm')')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    @lang('messages.no_data')
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="pagination-wrapper">
            {{ $latestLogs->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const ctx = document.getElementById('visitsChart').getContext('2d');
        const visitsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartData['labels'] ?? []),
                datasets: [{
                    label: '@lang('messages.total_visits')',
                    data: @json($chartData['data'] ?? []),
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#4f46e5',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                        },
                    },
                },
            },
        });
    </script>
</body>

</html>
