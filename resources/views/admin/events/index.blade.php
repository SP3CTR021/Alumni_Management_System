<x-layouts.admin>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Manage Events</h4>
        <a href="{{ route('admin.events.create') }}" class="btn btn-success">+ Create Event</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Date</th>
                <th>Venue</th>
                <th>Slots</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->event_date }}</td>
                <td>{{ $event->venue }}</td>
                <td>{{ $event->confirmedRsvps()->count() }} / {{ $event->max_slots }}</td>
                <td>
                    <span class="badge bg-{{ $event->status === 'published' ? 'success' : 'secondary' }}">
                        {{ ucfirst($event->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Delete this event?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">No events found.</td></tr>
            @endforelse
        </tbody>
    </table>
</x-layouts.admin>