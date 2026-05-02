<x-layouts.admin>
    <h4 class="mb-3">Edit Alumni</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.alumni.update', $alumnus) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $alumnus->name) }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $alumnus->email) }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Student ID</label>
                        <input type="text" name="student_id" class="form-control"
                               value="{{ old('student_id', $profile?->student_id) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Course</label>
                        <input type="text" name="course" class="form-control"
                               value="{{ old('course', $profile?->course) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Batch Year</label>
                        <input type="text" name="batch_year" class="form-control"
                               value="{{ old('batch_year', $profile?->batch_year) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Account Status</label>
                        <select name="status" class="form-select">
                            @foreach(['active','dormant','flagged'] as $s)
                                <option value="{{ $s }}" {{ old('status', $alumnus->status) === $s ? 'selected' : '' }}>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.alumni.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</x-layouts.admin>