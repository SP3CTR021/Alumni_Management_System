<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Information System - Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('layouts.partials.theme-styles')
    <style>
        .login-container { display: flex; min-height: 100vh; background: #F5F2ED; }
        .login-brand-panel {
            flex: 1;
            background: linear-gradient(135deg, #6B1020 0%, #4A0A16 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 3rem 2.5rem;
            color: white;
        }
        .brand-logo-wrapper { text-align: center; margin-bottom: 2rem; }
        .brand-circle {
            width: 80px;
            height: 80px;
            border: 3px solid #C9A84C;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            font-weight: 700;
            color: #C9A84C;
            font-family: 'Playfair Display', serif;
        }
        .brand-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0;
            line-height: 1.2;
        }
        .brand-tagline {
            font-size: 0.75rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #C9A84C;
            margin-top: 1.5rem;
            margin-bottom: 0;
        }
        .brand-divider {
            width: 60px;
            height: 1px;
            background: #C9A84C;
            margin: 1.5rem 0;
        }
        .brand-secondary {
            font-size: 0.75rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.7);
            margin: 0.5rem 0;
        }
        .brand-office {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.8);
            margin-top: 0.5rem;
        }
        .brand-quote {
            font-size: 0.95rem;
            font-style: italic;
            color: rgba(255,255,255,0.75);
            margin: 0;
            line-height: 1.6;
        }
        .login-form-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .login-form-wrapper {
            width: 100%;
            max-width: 380px;
        }
        .login-header { margin-bottom: 2rem; }
        .login-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: #6B1020;
            margin: 0 0 0.75rem 0;
        }
        .login-subtitle {
            color: #7A6E62;
            font-size: 0.95rem;
            margin: 0;
        }
        .form-group { margin-bottom: 1.5rem; }
        .form-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #4A3F35;
            margin-bottom: 0.6rem;
        }
        .form-group input {
            width: 100%;
            padding: 0.9rem 1rem;
            border: 1.5px solid #C8B89A;
            border-radius: 6px;
            font-size: 0.95rem;
            color: #1A1410;
        }
        .form-group input:focus {
            outline: none;
            border-color: #6B1020;
            box-shadow: 0 0 0 4px rgba(107,16,32,0.08);
        }
        .form-check {
            margin-bottom: 1rem;
        }
        .form-check-input {
            width: 20px;
            height: 20px;
            border: 1.5px solid #C8B89A;
            border-radius: 3px;
        }
        .form-check-input:checked {
            background: #6B1020;
            border-color: #6B1020;
        }
        .form-check-label {
            margin-left: 0.5rem;
            font-size: 0.9rem;
            color: #4A3F35;
        }
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .signin-btn {
            width: 100%;
            padding: 0.9rem;
            background: #6B1020;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            margin-bottom: 1.5rem;
        }
        .signin-btn:hover { background: #4A0A16; }
        .divider {
            text-align: center;
            color: #7A6E62;
            margin-bottom: 1.5rem;
        }
        .alt-links {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
        .admin-link {
            color: #6B1020;
            font-size: 0.9rem;
            text-decoration: none;
        }
        .admin-link:hover { text-decoration: underline; }
        .setup-link {
            display: block;
            width: 100%;
            padding: 0.9rem;
            background: transparent;
            color: #6B1020;
            border: 1.5px solid #6B1020;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
        }
        .setup-link:hover {
            background: rgba(107,16,32,0.05);
            color: #6B1020;
        }
        .signup-text {
            color: #7A6E62;
            font-size: 0.9rem;
        }
        .signup-link {
            color: #6B1020;
            text-decoration: none;
            font-weight: 600;
        }
        .signup-link:hover { text-decoration: underline; }
        @media (max-width: 768px) {
            .login-container { flex-direction: column; }
            .login-brand-panel { padding: 2rem; min-height: 40vh; }
            .brand-title { font-size: 1.5rem; }
            .login-form-panel { padding: 1.5rem; }
        }
    </style>
</head>
<body>
    @php($isAdminLogin = $isAdminLogin ?? false)
    @php($hasAdminAccount = $hasAdminAccount ?? true)
    <div class="login-container">
        <div class="login-brand-panel">
            <div class="brand-logo-wrapper">
                <div class="brand-circle">A</div>
                <h1 class="brand-title">Alumni<br>Information<br>System</h1>
                <p class="brand-tagline">Connecting Graduates</p>
                <div class="brand-divider"></div>
                <p class="brand-secondary">University of Excellence</p>
                <p class="brand-office">Office of Alumni Affairs</p>
            </div>
            <p class="brand-quote">"Nurturing bonds that transcend graduation - your journey continues here."</p>
        </div>

        <div class="login-form-panel">
            <div class="login-form-wrapper">
                <div class="login-header">
                    <h2 class="login-title">{{ $isAdminLogin ? 'Administrator Login' : 'Welcome Back' }}</h2>
                    <p class="login-subtitle">
                        {{ $isAdminLogin ? 'Sign in with your administrator account to manage approvals and records.' : 'Sign in to access the Alumni Information System' }}
                    </p>
                </div>

                @if(session('status'))
                    <div class="alert alert-success mb-3">{{ session('status') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger mb-3">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <input type="hidden" name="login_role" value="{{ $isAdminLogin ? 'admin' : 'alumni' }}">

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email') }}"
                               placeholder="{{ $isAdminLogin ? 'admin@university.edu.ph' : 'alumni@university.edu.ph' }}"
                               required>
                        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password"
                               placeholder="Enter your password"
                               required>
                        @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-footer">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                    </div>

                    <button type="submit" class="signin-btn">{{ $isAdminLogin ? 'Sign In as Administrator' : 'Sign In' }}</button>
                </form>

               

                <div class="divider">or</div>

                <div class="alt-links">
                    @if($isAdminLogin)
                        <a href="{{ route('login') }}" class="admin-link">Back to Alumni Login</a>
                        <a href="{{ route('admin.setup.create') }}" class="admin-link">Create First Administrator Account</a>
                    @else
                        <a href="{{ route('login', ['admin' => 1]) }}" class="admin-link">Continue as Administrator</a>
                    @endif

                    @unless($isAdminLogin)
                        <div>
                            <p class="signup-text">New graduate? <a href="{{ route('activate') }}" class="signup-link">Activate your account</a></p>
                        </div>
                        
                    @endunless
                </div>
            </div>
        </div>
    </div>
</body>
</html>
