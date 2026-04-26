<x-layouts.guest>
    <div class="auth-header text-center mb-4">
        <h2 class="auth-title">Create Administrator Account</h2>
        <p class="auth-copy">No administrator account was found. Set up the first admin to manage alumni approvals and system records.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.setup.store') }}" method="POST" class="card card-surface p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <x-input-label for="name">Full Name</x-input-label>
            <input type="text" id="name" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}"
                   placeholder="Administrator name"
                   required>
        </div>

        <div class="mb-3">
            <x-input-label for="email">Email Address</x-input-label>
            <input type="email" id="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   placeholder="admin@school.edu"
                   required>
        </div>

        <div class="mb-3">
            <x-input-label for="password">Password</x-input-label>
            <input type="password" id="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Minimum 8 characters"
                   required>
        </div>

        <div class="mb-4">
            <x-input-label for="password_confirmation">Confirm Password</x-input-label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="form-control"
                   required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Create Admin Account</button>
        <p class="text-muted small text-center mt-3 mb-0">
            This setup page automatically disables itself after the first admin account is created.
        </p>
    </form>
</x-layouts.guest>
