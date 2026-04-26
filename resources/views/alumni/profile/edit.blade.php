<x-layouts.app>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>My Profile</h4>
    </div>

    <div class="card">
        <div class="card-body">
            {{-- Read-only imported info --}}
            <div class="alert alert-info small mb-4">
                <strong>Imported Info:</strong>
                {{ auth()->user()->name }} ·
                {{ $profile?->course }} ·
                Batch {{ $profile?->batch_year }} ·
                {{ $profile?->student_id }}
            </div>

            <form action="{{ route('alumni.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <h6 class="text-muted mb-3">Personal Information</h6>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', $profile?->phone) }}">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address"
                               class="form-control"
                               value="{{ old('address', $profile?->address) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Civil Status</label>
                        <select name="civil_status" class="form-select">
                            <option value="">-- Select --</option>
                            @foreach(['single','married','widowed','separated'] as $status)
                                <option value="{{ $status }}" {{ old('civil_status', $profile?->civil_status) === $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sex</label>
                        <select name="sex" class="form-select">
                            <option value="">-- Select --</option>
                            <option value="male" {{ old('sex', $profile?->sex) === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('sex', $profile?->sex) === 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                </div>

                <hr>
                <h6 class="text-muted mb-3">Employment Information</h6>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Employer / Company</label>
                        <input type="text" name="employer"
                               class="form-control"
                               value="{{ old('employer', $profile?->employer) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Job Title</label>
                        <input type="text" name="job_title"
                               class="form-control"
                               value="{{ old('job_title', $profile?->job_title) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Industry</label>
                        <input type="text" name="industry"
                               class="form-control"
                               value="{{ old('industry', $profile?->industry) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Employment Type</label>
                        <select name="employment_type" class="form-select">
                            <option value="">-- Select --</option>
                            @foreach(['Full-time','Part-time','Freelance','Self-employed','Unemployed'] as $type)
                                <option value="{{ $type }}" {{ old('employment_type', $profile?->employment_type) === $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">LinkedIn URL</label>
                        <input type="url" name="linkedin"
                               class="form-control @error('linkedin') is-invalid @enderror"
                               value="{{ old('linkedin', $profile?->linkedin) }}"
                               placeholder="https://linkedin.com/in/yourname">
                        @error('linkedin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('alumni.dashboard') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</x-layouts.app>