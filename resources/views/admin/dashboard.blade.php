<x-layouts.admin>
    <div class="page-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1">Admin Dashboard</h1>
            <p class="text-muted mb-0">Monitor alumni activity, import status, and recent updates all in one place.</p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-sm-6">
            <div class="card card-surface h-100 shadow-sm">
                <div class="card-body text-center">
                    <span class="d-block text-muted mb-2">Total Alumni</span>
                    <h2 class="display-6 text-primary mb-0">{{ $totalAlumni }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-surface h-100 shadow-sm">
                <div class="card-body text-center">
                    <span class="d-block text-muted mb-2">Active Events</span>
                    <h2 class="display-6 text-success mb-0">{{ $totalEvents }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-surface h-100 shadow-sm">
                <div class="card-body text-center">
                    <span class="d-block text-muted mb-2">Announcements</span>
                    <h2 class="display-6 text-info mb-0">{{ $totalAnnouncements }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-surface h-100 shadow-sm">
                <div class="card-body text-center">
                    <span class="d-block text-muted mb-2">Latest Import</span>
                    @if($latestBatch)
                        <h2 class="display-6 mb-0 {{ $latestBatch->status === 'pending' ? 'text-warning' : 'text-success' }}">
                            {{ ucfirst($latestBatch->status) }}
                        </h2>
                        <small class="text-muted">Batch {{ $latestBatch->batch_year }}</small>
                    @else
                        <h2 class="display-6 text-muted mb-0">—</h2>
                        <small class="text-muted">No imports yet</small>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card card-surface shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">Pending Activations</h5>
                        <span class="badge bg-warning">{{ $pendingActivations ?? 0 }}</span>
                    </div>
                    <p class="text-muted small mb-3">Review alumni account activation requests.</p>
                    <a href="{{ route('admin.activations.index') }}" class="btn btn-sm btn-primary">Review Requests</a>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card card-surface shadow-sm">
                <div class="card-body">
                    <h5 class="mb-2">Import Controls</h5>
                    <p class="text-muted small mb-3">Run a new import scan to detect this year's graduates.</p>
                    <form action="{{ route('admin.import.trigger') }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Run import scan now?')">
                        @csrf
                        <button class="btn btn-sm btn-primary">Run Import Scan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-xl-8">
            <div class="card card-surface shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h5 class="mb-1">Approval Queue</h5>
                            <p class="text-muted small mb-0">Approve alumni here so their submitted credentials can be used to log in.</p>
                        </div>
                        <a href="{{ route('admin.activations.index') }}" class="btn btn-sm btn-outline-secondary">View All</a>
                    </div>

                    @if($recentPendingActivations->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom">
                                        <th class="text-muted small fw-600">Name</th>
                                        <th class="text-muted small fw-600">Email</th>
                                        <th class="text-muted small fw-600">Course</th>
                                        <th class="text-muted small fw-600">Batch</th>
                                        <th class="text-muted small fw-600">Submitted</th>
                                        <th class="text-muted small fw-600 text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentPendingActivations as $activation)
                                        <tr>
                                            <td>{{ $activation->user->name }}</td>
                                            <td class="text-muted">{{ $activation->user->email }}</td>
                                            <td>{{ $activation->course ?: 'N/A' }}</td>
                                            <td>{{ $activation->batch_year ?: 'N/A' }}</td>
                                            <td class="text-muted small">{{ $activation->submitted_at?->diffForHumans() ?: 'N/A' }}</td>
                                            <td>
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('admin.activations.show', $activation) }}" class="btn btn-sm btn-outline-primary">Review</a>
                                                    <form action="{{ route('admin.activations.approve', $activation) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Approve this alumni account and allow login?')">Approve</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted mb-0">There are no alumni waiting for approval right now.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card card-surface shadow-sm">
                <div class="card-body">
                    <h5 class="mb-2">Admin Actions</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.activations.index') }}" class="btn btn-sm btn-outline-secondary">Manage Activations</a>
                        <a href="{{ route('admin.import.index') }}" class="btn btn-sm btn-outline-secondary">View Import History</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
