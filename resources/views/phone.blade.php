<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@lang('messages.nav_phone') - Geo Genius</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">@lang('messages.nav_phone')</h4>
                    </div>
                    <div class="card-body">
                        {!! laravelGeoGenius()->initIntlPhoneInput() !!}

                        <form method="POST" action="{{ url('/phone') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input id="phone" type="tel" name="phone" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>

                        @if(session('success'))
                            <div class="alert alert-success mt-3">{{ session('success') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
