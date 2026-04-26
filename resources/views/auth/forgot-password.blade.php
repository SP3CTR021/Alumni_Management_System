<x-guest-layout>
    <div class="auth-header text-center mb-4">
        <h2 class="auth-title">Reset your password</h2>
        <p class="auth-copy">Enter your registered email below and we will send a password reset link.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a class="text-muted" href="{{ route('login') }}">Remembered your password?</a>
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
