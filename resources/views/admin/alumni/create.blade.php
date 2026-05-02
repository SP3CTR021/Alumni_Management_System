<x-layouts.admin>
    <h4 class="mb-3">Add Alumni</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.alumni.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Student ID</label>
                        <input type="text" name="student_id" class="form-control" value="{{ old('student_id') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Course</label>
                        <input type="text" name="course" class="form-control" value="{{ old('course') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Batch Year</label>
                        <input type="text" name="batch_year" class="form-control" value="{{ old('batch_year') }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.alumni.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</x-layouts.admin>