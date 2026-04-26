<x-layouts.app>
    @php
        $displayName = Str::of(auth()->user()->name)->before(' ');
        $metaItems = array_filter([
            $profile?->course,
            $profile?->batch_year ? 'Batch ' . $profile->batch_year : null,
            $profile?->status === 'approved' ? 'Active Alumni' : null,
            $profile?->department,
        ]);
    @endphp

    <style>
        .dashboard-shell {
            display: grid;
            gap: 2rem;
        }
        .dashboard-hero {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #741021 0%, #6b1020 60%, #7d1526 100%);
            border-radius: 14px;
            box-shadow: 0 14px 30px rgba(74, 10, 22, 0.18);
            padding: 2.4rem 2.6rem;
            color: #fff5ef;
        }
        .dashboard-hero::before,
        .dashboard-hero::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            border: 28px solid rgba(201, 168, 76, 0.08);
            pointer-events: none;
        }
        .dashboard-hero::before {
            width: 230px;
            height: 230px;
            right: 70px;
            top: -20px;
        }
        .dashboard-hero::after {
            width: 130px;
            height: 130px;
            right: 10px;
            bottom: -30px;
        }
        .dashboard-hero-inner {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
        }
        .dashboard-hero-title {
            margin: 0 0 0.5rem;
            color: #fff9f4;
            font-family: var(--font-display);
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
        }
        .dashboard-hero-meta {
            color: rgba(255, 240, 230, 0.86);
            font-size: 1.05rem;
        }
        .dashboard-hero-action {
            background: var(--gold);
            color: var(--maroon-deep);
            border-radius: 8px;
            padding: 1rem 1.4rem;
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 700;
            white-space: nowrap;
            box-shadow: 0 8px 24px rgba(41, 16, 3, 0.14);
        }
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.25rem;
        }
        .dashboard-stat {
            background: var(--white);
            border-radius: 12px;
            border: 1px solid #dbcdb7;
            box-shadow: var(--shadow);
            padding: 1.7rem 1.5rem;
        }
        .dashboard-stat--maroon { border-top: 3px solid var(--maroon); }
        .dashboard-stat--gold { border-top: 3px solid var(--gold); }
        .dashboard-stat--ink { border-top: 3px solid var(--charcoal); }
        .dashboard-stat-value {
            font-family: var(--font-display);
            font-size: 3rem;
            line-height: 1;
            color: var(--maroon);
        }
        .dashboard-stat--gold .dashboard-stat-value { color: var(--gold-dark); }
        .dashboard-stat--ink .dashboard-stat-value { color: #17243b; }
        .dashboard-stat-label {
            margin-top: 0.5rem;
            color: #8b6b47;
            font-size: 0.95rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(320px, 0.9fr);
            gap: 1.8rem;
            align-items: start;
        }
        .dashboard-panel {
            background: var(--white);
            border: 1px solid #dbcdb7;
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 1.55rem;
        }
        .dashboard-panel-title {
            margin: 0;
            color: var(--maroon);
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 700;
        }
        .dashboard-panel-copy {
            margin: 0.45rem 0 1.15rem;
            color: var(--text-muted);
            font-size: 0.98rem;
        }
        .dashboard-panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .dashboard-inline-btn {
            padding: 0.55rem 1rem;
            border: 1px solid var(--maroon-mid);
            border-radius: 8px;
            color: var(--maroon);
            font-size: 0.95rem;
        }
        .dashboard-progress-track {
            width: 100%;
            height: 10px;
            background: #ece1d2;
            border-radius: 999px;
            overflow: hidden;
            margin-bottom: 0.9rem;
        }
        .dashboard-progress-bar {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--maroon) 0%, #9c1c32 100%);
        }
        .dashboard-missing {
            color: var(--text-mid);
            font-size: 0.98rem;
        }
        .dashboard-section-title {
            margin: 0;
            color: var(--maroon);
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 700;
        }
        .dashboard-section-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .dashboard-section-link {
            color: var(--maroon);
            font-family: var(--font-ui);
            font-size: 1rem;
        }
        .announcement-stack {
            display: grid;
            gap: 1rem;
        }
        .announcement-card {
            background: var(--white);
            border: 1px solid #dbcdb7;
            border-left: 5px solid var(--maroon);
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 1.35rem 1.45rem;
        }
        .announcement-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 74px;
            padding: 0.25rem 0.65rem;
            margin-bottom: 0.85rem;
            border-radius: 4px;
            background: #f8ecee;
            border: 1px solid #e6c8cf;
            color: var(--maroon);
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .announcement-title {
            margin: 0 0 0.45rem;
            color: var(--black);
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 700;
        }
        .announcement-meta,
        .announcement-excerpt {
            color: var(--text-muted);
            font-size: 0.98rem;
        }
        .events-stack {
            display: grid;
            gap: 1rem;
        }
        .event-card {
            background: var(--white);
            border: 1px solid #dbcdb7;
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 1.25rem;
            display: grid;
            grid-template-columns: 72px minmax(0, 1fr);
            gap: 1rem;
        }
        .event-date {
            background: var(--maroon);
            border-radius: 8px;
            color: #fff6ef;
            text-align: center;
            padding: 0.65rem 0.4rem;
        }
        .event-date-month {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }
        .event-date-day {
            display: block;
            margin-top: 0.2rem;
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 700;
            line-height: 1;
            color: var(--gold);
        }
        .event-title {
            margin: 0 0 0.35rem;
            color: var(--black);
            font-family: var(--font-display);
            font-size: 1.2rem;
            font-weight: 700;
        }
        .event-meta {
            color: var(--text-muted);
            font-size: 0.98rem;
            margin-bottom: 0.9rem;
        }
        .event-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }
        .event-primary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 116px;
            padding: 0.55rem 1rem;
            border-radius: 8px;
            background: var(--white);
            border: 1px solid var(--maroon-mid);
            color: var(--maroon);
            font-size: 0.98rem;
        }
        .dashboard-empty {
            background: rgba(201, 168, 76, 0.08);
            border: 1px dashed #d6c29b;
            border-radius: 12px;
            color: var(--text-muted);
            padding: 1rem 1.1rem;
        }
        @media (max-width: 1100px) {
            .dashboard-stats {
                grid-template-columns: 1fr;
            }
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 767px) {
            .dashboard-hero {
                padding: 1.8rem 1.35rem;
            }
            .dashboard-hero-inner,
            .dashboard-panel-head,
            .dashboard-section-head {
                flex-direction: column;
                align-items: flex-start;
            }
            .event-card {
                grid-template-columns: 1fr;
            }
            .event-date {
                width: 74px;
            }
        }
    </style>

    <div class="dashboard-shell">
        <section class="dashboard-hero">
            <div class="dashboard-hero-inner">
                <div>
                    <h1 class="dashboard-hero-title">Welcome back, {{ $displayName }}!</h1>
                    <p class="dashboard-hero-meta mb-0">
                        {{ count($metaItems) ? implode(' · ', $metaItems) : 'Welcome to your alumni dashboard.' }}
                    </p>
                </div>
                <a href="{{ route('alumni.profile.edit') }}" class="dashboard-hero-action">Complete Profile →</a>
            </div>
        </section>

        <section class="dashboard-stats">
            <article class="dashboard-stat dashboard-stat--maroon">
                <div class="dashboard-stat-value">{{ $upcomingEventsCount }}</div>
                <div class="dashboard-stat-label">Upcoming Events</div>
            </article>
            <article class="dashboard-stat dashboard-stat--gold">
                <div class="dashboard-stat-value">{{ $profileCompletion }}%</div>
                <div class="dashboard-stat-label">Profile Complete</div>
            </article>
            <article class="dashboard-stat dashboard-stat--ink">
                <div class="dashboard-stat-value">{{ $announcementsCount }}</div>
                <div class="dashboard-stat-label">Announcements</div>
            </article>
        </section>

        <section class="dashboard-grid">
            <div class="d-grid gap-4">
                <article class="dashboard-panel">
                    <div class="dashboard-panel-head">
                        <div>
                            <h2 class="dashboard-panel-title">Profile Completion</h2>
                            <p class="dashboard-panel-copy">Add missing information to help fellow alumni connect with you.</p>
                        </div>
                        <a href="{{ route('alumni.profile.edit') }}" class="dashboard-inline-btn">Edit Profile</a>
                    </div>
                    <div class="dashboard-progress-track">
                        <div class="dashboard-progress-bar" style="width: {{ $profileCompletion }}%;"></div>
                    </div>
                    <p class="dashboard-missing mb-0">
                        @if($missingProfileItems->isNotEmpty())
                            Missing: {{ $missingProfileItems->join(', ') }}
                        @else
                            Your alumni profile is complete and ready for networking.
                        @endif
                    </p>
                </article>

                <section>
                    <div class="dashboard-section-head">
                        <h2 class="dashboard-section-title">Recent Announcements</h2>
                        <a href="{{ route('alumni.announcements.index') }}" class="dashboard-section-link">View all →</a>
                    </div>

                    <div class="announcement-stack">
                        @forelse($recentAnnouncements as $announcement)
                            <article class="announcement-card">
                                <span class="announcement-badge">{{ strtoupper($announcement->category) }}</span>
                                <h3 class="announcement-title">{{ $announcement->title }}</h3>
                                <p class="announcement-meta mb-2">
                                    {{ $announcement->published_at?->format('F d, Y') ?? $announcement->created_at?->format('F d, Y') }}
                                    · Posted by Admin
                                </p>
                                <p class="announcement-excerpt mb-3">{{ Str::limit($announcement->body, 135) }}</p>
                                <a href="{{ route('alumni.announcements.show', $announcement) }}" class="dashboard-section-link">Read more →</a>
                            </article>
                        @empty
                            <div class="dashboard-empty">No announcements yet. Stay tuned for updates from the alumni office.</div>
                        @endforelse
                    </div>
                </section>
            </div>

            <section>
                <div class="dashboard-section-head">
                    <h2 class="dashboard-section-title">Upcoming Events</h2>
                    <a href="{{ route('alumni.events.index') }}" class="dashboard-section-link">View all →</a>
                </div>

                <div class="events-stack">
                    @forelse($upcomingEvents as $event)
                        <article class="event-card">
                            <div class="event-date">
                                <span class="event-date-month">{{ \Illuminate\Support\Carbon::parse($event->event_date)->format('M') }}</span>
                                <span class="event-date-day">{{ \Illuminate\Support\Carbon::parse($event->event_date)->format('d') }}</span>
                            </div>
                            <div>
                                <h3 class="event-title">{{ $event->title }}</h3>
                                <p class="event-meta">
                                    {{ $event->start_time ? \Illuminate\Support\Carbon::parse($event->start_time)->format('g:i A') : 'Time TBA' }}
                                    · {{ $event->venue ?: 'Venue to be announced' }}
                                </p>
                                <div class="event-actions">
                                    <a href="{{ route('alumni.events.show', $event) }}" class="event-primary-btn">
                                        {{ $loop->first ? 'RSVP Now' : 'View Details' }}
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="dashboard-empty">No upcoming events yet. Check back soon for reunion schedules and alumni gatherings.</div>
                    @endforelse
                </div>
            </section>
        </section>
    </div>
</x-layouts.app>
