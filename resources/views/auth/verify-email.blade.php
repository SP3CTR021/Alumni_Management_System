<x-guest-layout>
    <div class="auth-header text-center mb-4">
        <h2 class="auth-title">Verify your email address</h2>
        <p class="auth-copy">We sent a verification link to your email. Please click the link to continue.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mb-4">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary">{{ __('Log Out') }}</button>
        </form>
    </div>
</x-guest-layout>
