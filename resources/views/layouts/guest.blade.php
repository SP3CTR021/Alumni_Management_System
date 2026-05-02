<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Information System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('layouts.partials.theme-styles')
</head>
<body>
    <div class="auth-shell">
        <div class="auth-card">
            <div class="auth-panel">
                <div class="auth-brand">
                    <div class="brand-mark">A</div>
                    <h1 class="auth-title">Alumni Information System</h1>
                </div>

                @if(session('status'))
                    <div class="alert alert-success mb-4">{{ session('status') }}</div>
                @endif

                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
