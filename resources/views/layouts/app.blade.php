<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Information System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('layouts.partials.theme-styles')
    <style>
        .alumni-top-nav {
            background: var(--maroon-deep);
            border-bottom: 3px solid var(--gold);
            padding: 0 1rem;
        }
        .alumni-nav-inner {
            max-width: 1440px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            min-height: 78px;
        }
        .alumni-nav-logo {
            min-width: 290px;
            color: var(--gold);
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 700;
            line-height: 1.05;
        }
        .alumni-nav-logo strong {
            display: block;
            font-size: 1.25rem;
            letter-spacing: -0.02em;
        }
        .alumni-nav-logo span {
            display: block;
            margin-top: 0.3rem;
            color: rgba(253,250,246,0.72);
            font-family: var(--font-body);
            font-size: 0.78rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
        }
        .alumni-nav-links {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            flex: 1;
            overflow-x: auto;
        }
        .alumni-nav-link,
        .alumni-nav-link-static {
            color: rgba(253,250,246,0.88);
            font-family: var(--font-ui);
            font-size: 0.95rem;
            padding: 1.15rem 0.7rem 0.9rem;
            border-bottom: 3px solid transparent;
            white-space: nowrap;
        }
        .alumni-nav-link:hover {
            color: var(--white);
        }
        .alumni-nav-link.active {
            color: var(--gold);
            border-bottom-color: var(--gold);
        }
        .alumni-nav-link-static {
            opacity: 0.85;
            cursor: default;
        }
        .alumni-nav-user {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            color: rgba(253,250,246,0.92);
            white-space: nowrap;
        }
        .alumni-nav-user-name {
            font-family: var(--font-ui);
            font-size: 1rem;
        }
        .alumni-nav-divider {
            color: rgba(253,250,246,0.45);
        }
        .alumni-signout {
            border: 0;
            background: transparent;
            color: rgba(253,250,246,0.92);
            padding: 0;
            font-family: var(--font-ui);
        }
        .alumni-signout:hover {
            color: var(--gold);
        }
        .alumni-main {
            max-width: 1440px;
            margin: 0 auto;
            padding: 2.75rem 1.25rem 4rem;
        }
        @media (max-width: 991px) {
            .alumni-nav-inner {
                flex-wrap: wrap;
                justify-content: center;
                padding: 1rem 0;
            }
            .alumni-nav-logo {
                min-width: 0;
                text-align: center;
            }
            .alumni-nav-links {
                justify-content: center;
            }
            .alumni-main {
                padding-top: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <nav class="alumni-top-nav">
        <div class="alumni-nav-inner">
            <a class="alumni-nav-logo" href="{{ route('alumni.dashboard') }}">
                <strong>Alumni IS</strong>
                <span>University Of Excellence</span>
            </a>

            <div class="alumni-nav-links">
                <a class="alumni-nav-link {{ request()->routeIs('alumni.dashboard') ? 'active' : '' }}" href="{{ route('alumni.dashboard') }}">Dashboard</a>
                <a class="alumni-nav-link {{ request()->routeIs('alumni.profile.*') ? 'active' : '' }}" href="{{ route('alumni.profile.edit') }}">My Profile</a>
                <a class="alumni-nav-link {{ request()->routeIs('alumni.events.*') ? 'active' : '' }}" href="{{ route('alumni.events.index') }}">Events</a>
                <a class="alumni-nav-link {{ request()->routeIs('alumni.announcements.*') ? 'active' : '' }}" href="{{ route('alumni.announcements.index') }}">Announcements</a>
                <a class="alumni-nav-link {{ request()->routeIs('alumni.directory') ? 'active' : '' }}" href="{{ route('alumni.directory') }}">Directory</a>
            </div>

            @php
                $name = auth()->user()?->name ?? 'User';
                $initials = collect(explode(' ', $name))->map(fn($part) => strtoupper(substr($part, 0, 1)))->join('');
            @endphp
            <div class="alumni-nav-user">
                <div class="nav-avatar">{{ Str::limit($initials, 2, '') }}</div>
                <span class="alumni-nav-user-name">{{ $name }}</span>
                <span class="alumni-nav-divider">|</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline ms-2">
                    @csrf
                    <button type="submit" class="alumni-signout">Sign Out</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="alumni-main">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
