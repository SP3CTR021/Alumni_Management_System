<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Information System · Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('layouts.partials.theme-styles')
</head>
<body>
    <nav class="top-nav">
        <div class="nav-inner">
            <a class="nav-logo" href="{{ route('admin.dashboard') }}">
                Alumni Information System
                <span>Admin Console</span>
            </a>

            @php
                $name = auth()->user()?->name ?? 'Admin';
                $initials = collect(explode(' ', $name))->map(fn($part) => strtoupper(substr($part, 0, 1)))->join('');
            @endphp
            <div class="nav-user">
                <div class="nav-avatar">{{ Str::limit($initials, 2, '') }}</div>
                <span>{{ $name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline ms-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="admin-layout">
        <aside class="sidebar">
            <div class="sidebar-section">
                <div class="sidebar-section-label">Navigation</div>
                @if(auth()->user()->role === 'admin')
                    <a class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <a class="sidebar-item {{ request()->routeIs('admin.activations.*') ? 'active' : '' }}" href="{{ route('admin.activations.index') }}">Activation Requests</a>
                    <a class="sidebar-item {{ request()->routeIs('admin.alumni.*') ? 'active' : '' }}" href="{{ route('admin.alumni.index') }}">Alumni Records</a>
                    <a class="sidebar-item {{ request()->routeIs('admin.events.*') ? 'active' : '' }}" href="{{ route('admin.events.index') }}">Events</a>
                    <a class="sidebar-item {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}" href="{{ route('admin.announcements.index') }}">Announcements</a>
                    <a class="sidebar-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}">Reports</a>
                    <a class="sidebar-item {{ request()->routeIs('admin.import.*') ? 'active' : '' }}" href="{{ route('admin.import.index') }}">Import</a>
                @else
                    <a class="sidebar-item {{ request()->routeIs('registrar.import.*') ? 'active' : '' }}" href="{{ route('registrar.import.index') }}">Import Review</a>
                @endif
            </div>

            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary w-100">Logout</button>
                </form>
            </div>
        </aside>

        <main class="main-area">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
