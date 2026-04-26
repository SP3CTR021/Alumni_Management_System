<x-layouts.admin>
    <div class="page-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1">Pending Activations</h1>
            <p class="text-muted mb-0">Review and approve alumni account activation requests.</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-sm-6">
            <div class="card card-surface h-100 shadow-sm">
                <div class="card-body text-center">
                    <span class="d-block text-muted mb-2">Pending</span>
                    <h2 class="display-6 text-warning mb-0">{{ $stats['pending'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-surface h-100 shadow-sm">
                <div class="card-body text-center">
                    <span class="d-block text-muted mb-2">Approved</span>
                    <h2 class="display-6 text-success mb-0">{{ $stats['approved'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card card-surface h-100 shadow-sm">
                <div class="card-body text-center">
                    <span class="d-block text-muted mb-2">Rejected</span>
                    <h2 class="display-6 text-danger mb-0">{{ $stats['rejected'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    @if($activations->count() > 0)
        <div class="card card-surface shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr class="border-bottom">
                                <th scope="col" class="text-muted small fw-600">Name</th>
                                <th scope="col" class="text-muted small fw-600">Email</th>
                                <th scope="col" class="text-muted small fw-600">Course</th>
                                <th scope="col" class="text-muted small fw-600">Year Graduated</th>
                                <th scope="col" class="text-muted small fw-600">Submitted</th>
                                <th scope="col" class="text-muted small fw-600">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activations as $activation)
                                <tr>
                                    <td class="align-middle">
                                        <strong>{{ $activation->user->name }}</strong>
                                    </td>
                                    <td class="align-middle text-muted">{{ $activation->user->email }}</td>
                                    <td class="align-middle">{{ $activation->course ?? '—' }}</td>
                                    <td class="align-middle">{{ $activation->batch_year ?? '—' }}</td>
                                    <td class="align-middle text-muted small">{{ $activation->submitted_at?->diffForHumans() ?? '—' }}</td>
                                    <td class="align-middle">
                                        <a href="{{ route('admin.activations.show', $activation) }}" class="btn btn-sm btn-outline-primary">Review</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $activations->links() }}
        </div>
    @else
        <div class="card card-surface shadow-sm">
            <div class="card-body text-center py-5">
                <p class="text-muted mb-0">No pending activation requests at this time.</p>
            </div>
        </div>
    @endif
</x-layouts.admin>
