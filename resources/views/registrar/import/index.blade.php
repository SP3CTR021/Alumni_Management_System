<x-layouts.admin>
    <h4 class="mb-3">Import Review</h4>

    @if(!$batch)
        <div class="alert alert-info">No pending import batch. Ask admin to run an import scan first.</div>
    @else
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h2 class="text-primary">{{ $batch->records->count() }}</h2>
                        <small class="text-muted">Total Detected</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h2 class="text-success">{{ $batch->clearedRecords()->count() }}</h2>
                        <small class="text-muted">Cleared</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h2 class="text-danger">{{ $batch->flaggedRecords()->count() }}</h2>
                        <small class="text-muted">Flagged — On Hold</small>
                    </div>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs mb-3" id="importTabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#cleared">Cleared ({{ $batch->clearedRecords()->count() }})</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#flagged">Flagged ({{ $batch->flaggedRecords()->count() }})</a>
            </li>
        </ul>

        <div class="tab-content">
            {{-- CLEARED TAB --}}
            <div class="tab-pane fade show active" id="cleared">
                <table class="table table-bordered table-striped">
                    <thead class="table-success">
                        <tr><th>Name</th><th>Email</th><th>Course</th><th>Batch</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse($batch->clearedRecords as $record)
                        <tr>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->email }}</td>
                            <td>{{ $record->course }}</td>
                            <td>{{ $record->batch_year }}</td>
                            <td><span class="badge bg-success">Cleared</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">No cleared records.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- FLAGGED TAB --}}
            <div class="tab-pane fade" id="flagged">
                <table class="table table-bordered table-striped">
                    <thead class="table-danger">
                        <tr><th>Name</th><th>Email</th><th>Course</th><th>Batch</th><th>Flag Reasons</th></tr>
                    </thead>
                    <tbody>
                        @forelse($batch->flaggedRecords as $record)
                        <tr>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->email }}</td>
                            <td>{{ $record->course }}</td>
                            <td>{{ $record->batch_year }}</td>
                            <td>
                                @if($record->flag_reasons)
                                    @foreach($record->flag_reasons as $reason)
                                        <span class="badge bg-danger me-1">{{ $reason }}</span>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">No flagged records.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Confirm / Reject --}}
        <div class="card mt-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <strong>Ready to push {{ $batch->clearedRecords()->count() }} cleared records?</strong>
                    <p class="text-muted small mb-0">Flagged students will remain on hold.</p>
                </div>
                <div class="d-flex gap-2">
                    <form action="{{ route('registrar.import.reject', $batch) }}" method="POST"
                          onsubmit="return confirm('Reject this import?')">
                        @csrf
                        <button class="btn btn-outline-danger">Reject & Return</button>
                    </form>
                    <form action="{{ route('registrar.import.confirm', $batch) }}" method="POST"
                          onsubmit="return confirm('Confirm import for {{ $batch->clearedRecords()->count() }} cleared students?')">
                        @csrf
                        <button class="btn btn-success">Confirm Import →</button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</x-layouts.admin>