<x-layouts.app>
    <style>
        .events-header {
            margin-bottom: 2.5rem;
        }
        .events-header h1 {
            font-size: 2.25rem;
            font-family: var(--font-display);
            color: #5a1621;
            margin-bottom: 0.5rem;
        }
        .events-header p {
            color: #6c6257;
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }
        .events-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.75rem;
        }
        .event-card {
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 18px 35px rgba(66, 19, 24, 0.12);
            background: #fdf8f3;
            border: 1px solid rgba(178, 147, 125, 0.22);
        }
        .event-card-header {
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: start;
            gap: 1rem;
            padding: 1.35rem 1.5rem;
            background: #5a1621;
            color: #f9efe8;
        }
        .event-card-header .event-day {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
        }
        .event-card-header .event-month {
            text-transform: uppercase;
            letter-spacing: 0.16em;
            font-size: 0.8rem;
            color: rgba(255,255,255,0.72);
        }
        .event-card-header .event-weekday {
            font-size: 0.95rem;
            margin-top: 0.6rem;
            color: rgba(255,255,255,0.82);
        }
        .event-card-content {
            padding: 1.75rem 1.5rem 1.5rem;
        }
        .event-card-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.45rem 0.85rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            background: #f4e8d6;
            color: #7a4e39;
            margin-bottom: 0.9rem;
        }
        .event-card-title {
            font-size: 1.35rem;
            margin-bottom: 0.75rem;
            color: #5a1621;
        }
        .event-card-meta {
            font-size: 0.95rem;
            color: #7a6e62;
            margin-bottom: 1rem;
        }
        .event-card-description {
            color: #5a4d45;
            line-height: 1.75;
            margin-bottom: 1.5rem;
        }
        .event-card-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }
        .event-card-actions .btn {
            min-width: 120px;
        }
        @media (max-width: 1199px) {
            .events-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (max-width: 767px) {
            .events-grid {
                grid-template-columns: 1fr;
            }
            .event-card-header {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="events-header">
        <h1>Events</h1>
        <p>Upcoming alumni gatherings, career fairs, and university events</p>
        <hr>
    </div>

    @if($events->isEmpty())
        <p class="text-muted">No events available.</p>
    @else
        <div class="events-grid">
            @foreach($events as $event)
                @php
                    $eventDate = \Carbon\Carbon::parse($event->event_date);
                @endphp
                <article class="event-card">
                    <div class="event-card-header">
                        <div>
                            <div class="event-day">{{ $eventDate->format('j') }}</div>
                            <div class="event-weekday">{{ $eventDate->format('l') }}</div>
                        </div>
                        <div class="text-end">
                            <div class="event-month">{{ $eventDate->format('F Y') }}</div>
                        </div>
                    </div>
                    <div class="event-card-content">
                        <span class="event-card-badge">Event</span>
                        <h2 class="event-card-title">{{ $event->title }}</h2>
                        <div class="event-card-meta">
                            {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} · {{ $event->venue }} · {{ $event->confirmedRsvps()->count() }} slots
                        </div>
                        <p class="event-card-description">{{ Str::limit($event->description, 130) }}</p>
                        <div class="event-card-actions">
                            <a href="{{ route('alumni.events.show', $event) }}" class="btn btn-outline-secondary">Details</a>
                            <a href="{{ route('alumni.events.show', $event) }}" class="btn btn-primary">RSVP Now</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</x-layouts.app>