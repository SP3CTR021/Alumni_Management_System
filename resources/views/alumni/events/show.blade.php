<x-layouts.app>
    <a href="{{ route('alumni.events.index') }}" class="btn btn-sm btn-secondary mb-3">← Back to Events</a>

    <div class="card">
        <div class="card-body">
            <h4 class="mb-1">{{ $event->title }}</h4>
            <p class="text-muted small mb-3">
                {{ $event->event_date }} at {{ $event->start_time }} · {{ $event->venue }}
            </p>
            <p>{{ $event->description }}</p>
            <hr>
            <p><strong>Slots:</strong> {{ $event->confirmedRsvps()->count() }} / {{ $event->max_slots }}</p>

            @if($isRsvped)
                <span class="badge bg-success me-2">You are registered</span>
                <form action="{{ route('alumni.events.cancel-rsvp', $event) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Cancel your RSVP?')">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger">Cancel RSVP</button>
                </form>
            @else
                <form action="{{ route('alumni.events.rsvp', $event) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-primary">RSVP Now</button>
                </form>
            @endif
        </div>
    </div>
</x-layouts.app>