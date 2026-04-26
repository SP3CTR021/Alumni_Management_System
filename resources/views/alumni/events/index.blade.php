<x-layouts.app>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Events</h4>
    </div>

    @forelse($events as $event)
        <div class="card mb-3" style="border-left: 3px solid #2C3E6B;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-primary fw-bold">{{ $event->event_date }} · {{ $event->start_time }}</small>
                        <h6 class="mb-1">{{ $event->title }}</h6>
                        <small class="text-muted">{{ $event->venue }}</small>
                    </div>
                    <div>
                        <span class="badge bg-secondary">
                            {{ $event->confirmedRsvps()->count() }} / {{ $event->max_slots }} slots
                        </span>
                    </div>
                </div>
                <div class="mt-2">
                    <a href="{{ route('alumni.events.show', $event) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">No events available.</p>
    @endforelse
</x-layouts.app>