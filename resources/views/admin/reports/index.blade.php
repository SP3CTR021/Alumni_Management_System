<x-layouts.admin>
    <h4 class="mb-4">Reports & Analytics</h4>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h2 class="text-primary">{{ $totalAlumni }}</h2>
                    <small class="text-muted">Total Alumni</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h2 class="text-success">{{ $employed }}</h2>
                    <small class="text-muted">Employed</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h2 class="text-warning">{{ $unemployed }}</h2>
                    <small class="text-muted">Not yet updated employment</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Alumni per Batch Year</h6>
                    <table class="table table-sm table-bordered">
                        <thead class="table-light">
                            <tr><th>Batch Year</th><th>Count</th></tr>
                        </thead>
                        <tbody>
                            @forelse($perBatch as $row)
                            <tr>
                                <td>{{ $row->batch_year ?? 'Unknown' }}</td>
                                <td>{{ $row->total }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="2" class="text-center">No data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Event Attendance</h6>
                    <table class="table table-sm table-bordered">
                        <thead class="table-light">
                            <tr><th>Event</th><th>RSVPs</th><th>Max Slots</th></tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->confirmed_rsvps_count }}</td>
                                <td>{{ $event->max_slots }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center">No events.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>