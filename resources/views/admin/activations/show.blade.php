<x-layouts.admin>
    <div class="page-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1">Review Activation Request</h1>
            <p class="text-muted mb-0">Verify alumni details and approve or reject the activation.</p>
        </div>
        <a href="{{ route('admin.activations.index') }}" class="btn btn-outline-secondary">← Back to List</a>
    </div>

    <div class="row g-4">
        <!-- Applicant Information -->
        <div class="col-lg-8">
            <div class="card card-surface shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="mb-4">Applicant Information</h5>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase">Full Name</label>
                            <p class="mb-0 fw-500">{{ $profile->user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase">Email</label>
                            <p class="mb-0 fw-500">{{ $profile->user->email }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase">Course/Program</label>
                            <p class="mb-0 fw-500">{{ $profile->course ?? 'Not provided' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase">Year Graduated</label>
                            <p class="mb-0 fw-500">{{ $profile->batch_year ?? 'Not provided' }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase">Submitted</label>
                            <p class="mb-0 fw-500">{{ $profile->submitted_at?->format('M d, Y H:i') ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted text-uppercase">Status</label>
                            <p class="mb-0">
                                <span class="badge bg-warning">{{ ucfirst($profile->status) }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Forms -->
            <div class="row g-3">
                <!-- Approve Form -->
                <div class="col-md-6">
                    <form action="{{ route('admin.activations.approve', $profile) }}" method="POST" class="card card-surface shadow-sm">
                        @csrf
                        <div class="card-body">
                            <h6 class="mb-3 text-success">✓ Approve Activation</h6>
                            <p class="text-muted small mb-3">
                                Approving this request will allow the alumni to log in to the system.
                            </p>
                            <button type="submit" class="btn btn-success w-100">Approve Account</button>
                        </div>
                    </form>
                </div>

                <!-- Reject Form -->
                <div class="col-md-6">
                    <div class="card card-surface shadow-sm">
                        <div class="card-body">
                            <h6 class="mb-3 text-danger">✗ Reject Activation</h6>
                            <form action="{{ route('admin.activations.reject', $profile) }}" method="POST" id="rejectForm">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label small">Reason for Rejection</label>
                                    <textarea name="rejection_reason" class="form-control @error('rejection_reason') is-invalid @enderror" 
                                              rows="3" placeholder="Explain why this account is being rejected..." required></textarea>
                                    @error('rejection_reason') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>
                                <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure? This will reject the account.')">Reject Account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline Sidebar -->
        <div class="col-lg-4">
            <div class="card card-surface shadow-sm">
                <div class="card-body">
                    <h6 class="mb-3">Timeline</h6>

                    <div class="timeline">
                        <div class="timeline-item mb-3">
                            <div class="timeline-marker bg-info"></div>
                            <div>
                                <p class="small text-muted mb-0">Request Submitted</p>
                                <strong class="small">{{ $profile->submitted_at?->format('M d, Y H:i') ?? 'N/A' }}</strong>
                            </div>
                        </div>

                        @if($profile->reviewed_at)
                            <div class="timeline-item mb-3">
                                <div class="timeline-marker {{ $profile->status === 'approved' ? 'bg-success' : 'bg-danger' }}"></div>
                                <div>
                                    <p class="small text-muted mb-0">
                                        {{ $profile->status === 'approved' ? 'Approved' : 'Rejected' }}
                                    </p>
                                    <strong class="small">{{ $profile->reviewed_at->format('M d, Y H:i') }}</strong>
                                    @if($profile->reviewer)
                                        <p class="small text-muted mb-0">by {{ $profile->reviewer->name }}</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    <style>
                        .timeline {
                            position: relative;
                            padding-left: 20px;
                        }
                        .timeline-item {
                            position: relative;
                        }
                        .timeline-marker {
                            position: absolute;
                            width: 12px;
                            height: 12px;
                            border-radius: 50%;
                            left: -25px;
                            top: 2px;
                        }
                        .timeline::before {
                            content: '';
                            position: absolute;
                            left: -21px;
                            top: 0;
                            bottom: 0;
                            width: 2px;
                            background: #ddd;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
