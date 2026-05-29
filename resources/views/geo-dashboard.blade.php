<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Geo Analytics Dashboard</title>

    <!-- Bootstrap 5 -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f4f7fc;
            font-family:Arial, sans-serif;
        }

        .dashboard-container{
            padding:40px 20px;
        }

        .dashboard-title{
            font-size:32px;
            font-weight:700;
            color:#111827;
            margin-bottom:30px;
        }

        .stats-card{
            border:none;
            border-radius:16px;
            padding:25px;
            box-shadow:0 4px 12px rgba(0,0,0,0.08);
            transition:0.3s ease;
            background:white;
        }

        .stats-card:hover{
            transform:translateY(-5px);
        }

        .stats-number{
            font-size:38px;
            font-weight:bold;
            color:#4f46e5;
        }

        .stats-text{
            font-size:18px;
            color:#6b7280;
        }

        .table-container{
            background:white;
            border-radius:16px;
            overflow:hidden;
            box-shadow:0 4px 12px rgba(0,0,0,0.08);
        }

        .table thead{
            background:#111827;
            color:white;
        }

        .table th{
            padding:16px;
            font-size:14px;
            white-space:nowrap;
            border:none;
        }

        .table td{
            padding:16px;
            vertical-align:middle;
            font-size:14px;
            color:#374151;
            border-color:#f1f5f9;
        }

        .table tbody tr:hover{
            background:#f8fafc;
        }

        .badge-browser{
            background:#e0e7ff;
            color:#3730a3;
            padding:8px 14px;
            border-radius:30px;
            font-size:12px;
            font-weight:600;
        }

        .badge-platform{
            background:#dcfce7;
            color:#166534;
            padding:8px 14px;
            border-radius:30px;
            font-size:12px;
            font-weight:600;
        }

        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        .pagination-wrapper{
            margin-top:25px;
        }

        .pagination-wrapper nav{
            display:flex;
            justify-content:space-between;
            align-items:center;
            width:100%;
            flex-wrap:wrap;
            gap:15px;
        }

        .pagination-wrapper svg{
            width:18px;
            height:18px;
        }

        .pagination{
            margin:0;
        }

        .pagination .page-link{
            border:none;
            margin:0 4px;
            border-radius:10px !important;
            min-width:42px;
            height:42px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:600;
            color:#111827;
            box-shadow:0 2px 6px rgba(0,0,0,0.08);
            transition:0.3s ease;
        }

        .pagination .page-link:hover{
            background:#4f46e5;
            color:white;
        }

        .pagination .page-item.active .page-link{
            background:#4f46e5;
            color:white;
            border:none;
        }

        .pagination .page-item.disabled .page-link{
            background:#f3f4f6;
            color:#9ca3af;
        }

        @media(max-width:768px){

            .dashboard-title{
                font-size:26px;
            }

            .stats-number{
                font-size:30px;
            }

            .table th,
            .table td{
                font-size:13px;
                padding:12px;
            }

            .pagination-wrapper nav{
                flex-direction:column;
                align-items:center;
                text-align:center;
            }
        }

    </style>

</head>

<body>

    <div class="container dashboard-container">

        <h1 class="dashboard-title">
            🌍 Geo Analytics Dashboard
        </h1>

        <!-- STATS CARDS -->

        <div class="row g-4 mb-4">

            <div class="col-md-4">

                <div class="card stats-card">

                    <div class="stats-number">
                        {{ $totalVisits }}
                    </div>

                    <div class="stats-text">
                        Total Visits
                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card stats-card">

                    <div class="stats-number">
                        {{ $uniqueCountries }}
                    </div>

                    <div class="stats-text">
                        Unique Countries
                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card stats-card">

                    <div class="stats-number">
                        {{ $uniqueCities }}
                    </div>

                    <div class="stats-text">
                        Unique Cities
                    </div>

                </div>

            </div>

        </div>

        <!-- TABLE -->

        <div class="table-container">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>

                        <tr>

                            <th>IP Address</th>

                            <th>Country</th>

                            <th>City</th>

                            <th>Timezone</th>

                            <th>Browser</th>

                            <th>Platform</th>

                            <th>Visited At</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($latestLogs as $log)

                            <tr>

                                <td>{{ $log->ip_address }}</td>

                                <td>{{ $log->country }}</td>

                                <td>{{ $log->city }}</td>

                                <td>{{ $log->timezone }}</td>

                                <td>
                                    <span class="badge-browser">
                                        {{ $log->browser }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge-platform">
                                        {{ $log->platform }}
                                    </span>
                                </td>

                                <td>{{ $log->visited_at }}</td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center py-4">
                                    No Geo Analytics Data Found
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <!-- PAGINATION -->

        <div class="pagination-wrapper">

            {{ $latestLogs->links() }}

        </div>

    </div>

</body>

</html>