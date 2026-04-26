<x-layouts.guest>
    <div class="auth-header text-center mb-4">
        <h2 class="auth-title">Activate your alumni account</h2>
        <p class="auth-copy">Fill in your details below. Your account will be reviewed by our admin team.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('activate.post') }}" method="POST" class="card card-surface p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <x-input-label for="name">Full Name</x-input-label>
            <input type="text" id="name" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}"
                   placeholder="Your full name"
                   required>
            @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <x-input-label for="email">Email Address</x-input-label>
            <input type="email" id="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   placeholder="your@school.edu.ph"
                   required>
            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <x-input-label for="batch_year">Year Graduated</x-input-label>
            <input type="number" id="batch_year" name="batch_year"
                   class="form-control @error('batch_year') is-invalid @enderror"
                   value="{{ old('batch_year') }}"
                   placeholder="e.g., 2020"
                   min="1900"
                   max="{{ date('Y') }}"
                   required>
            @error('batch_year') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <x-input-label for="course">Course/Program</x-input-label>
            <input type="text" id="course" name="course"
                   class="form-control @error('course') is-invalid @enderror"
                   value="{{ old('course') }}"
                   placeholder="e.g., Bachelor of Science in Computer Science"
                   required>
            @error('course') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <x-input-label for="password">Create Password</x-input-label>
            <input type="password" id="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Min. 8 characters"
                   required>
            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <x-input-label for="password_confirmation">Confirm Password</x-input-label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Wait for Admin Approval</button>
        <p class="text-muted small text-center mt-3 mb-0">After submission, you will be returned to the login page and your account will stay pending until an admin approves it.</p>
    </form>
</x-layouts.guest>
