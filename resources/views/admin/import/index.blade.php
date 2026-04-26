<x-layouts.admin>
    <h4 class="mb-3">Import History</h4>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Batch Year</th>
                <th>Status</th>
                <th>Cleared</th>
                <th>Flagged</th>
                <th>Confirmed By</th>
                <th>Confirmed At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($batches as $batch)
            <tr>
                <td>{{ $batch->id }}</td>
                <td>{{ $batch->batch_year }}</td>
                <td>
                    <span class="badge bg-{{ $batch->status === 'confirmed' ? 'success' : ($batch->status === 'rejected' ? 'danger' : 'warning') }}">
                        {{ ucfirst($batch->status) }}
                    </span>
                </td>
                <td>{{ $batch->clearedRecords()->count() }}</td>
                <td>{{ $batch->flaggedRecords()->count() }}</td>
                <td>{{ $batch->confirmedBy?->name ?? '—' }}</td>
                <td>{{ $batch->confirmed_at ?? '—' }}</td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">No imports yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</x-layouts.admin>