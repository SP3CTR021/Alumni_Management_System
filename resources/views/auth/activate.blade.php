<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activation - Alumni Information System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('layouts.partials.theme-styles')
    <style>
        .activation-container {
            display: flex;
            min-height: 100vh;
            background: #F5F2ED;
        }
        .activation-sidebar {
            flex: 0 0 35%;
            background: linear-gradient(135deg, #6B1020 0%, #4A0A16 100%);
            padding: 3rem 2.5rem;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar-brand {
            text-align: center;
            margin-bottom: 2rem;
        }
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
        .sidebar-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 0.5rem;
        }
        .sidebar-tagline {
            font-size: 0.75rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #C9A84C;
            margin-bottom: 1.5rem;
        }
        .sidebar-divider {
            width: 60px;
            height: 1px;
            background: #C9A84C;
            margin: 1.5rem 0;
        }
        .sidebar-description {
            font-size: 0.95rem;
            line-height: 1.6;
            color: rgba(255,255,255,0.85);
        }
        .sidebar-quote {
            font-size: 0.95rem;
            font-style: italic;
            color: rgba(255,255,255,0.75);
            margin: 0;
        }
        .activation-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .activation-form-wrapper {
            width: 100%;
            max-width: 520px;
        }
        .activation-header {
            margin-bottom: 2rem;
        }
        .activation-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: #6B1020;
            margin-bottom: 0.5rem;
        }
        .activation-subtitle {
            color: #7A6E62;
            font-size: 0.95rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
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
        .form-group select {
            width: 100%;
            padding: 0.9rem 1rem;
            border: 1.5px solid #C8B89A;
            border-radius: 6px;
            font-size: 0.95rem;
            color: #1A1410;
            background-color: white;
            cursor: pointer;
        }
        .form-group select:focus {
            outline: none;
            border-color: #6B1020;
            box-shadow: 0 0 0 4px rgba(107,16,32,0.08);
        }
        .form-group select option {
            padding: 0.5rem;
            color: #1A1410;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .form-check {
            margin-bottom: 1.5rem;
        }
        .form-check-input {
            width: 20px;
            height: 20px;
            border: 1.5px solid #C8B89A;
            border-radius: 3px;
            accent-color: #6B1020;
        }
        .form-check-label {
            margin-left: 0.5rem;
            font-size: 0.9rem;
            color: #4A3F35;
            margin-top: 0.25rem;
        }
        .form-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .btn-back {
            padding: 0.9rem 1rem;
            background: transparent;
            color: #6B1020;
            border: 1.5px solid #6B1020;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-back:hover {
            background: rgba(107,16,32,0.05);
            color: #6B1020;
        }
        .btn-activate {
            padding: 0.9rem 1rem;
            background: #6B1020;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-activate:hover {
            background: #4A0A16;
        }
        @media (max-width: 768px) {
            .activation-container {
                flex-direction: column;
            }
            .activation-sidebar {
                flex: 0 0 auto;
                padding: 2rem;
            }
            .sidebar-title {
                font-size: 1.5rem;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
            .form-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="activation-container">
        <div class="activation-sidebar">
            <div class="sidebar-brand">
                <div class="brand-circle">A</div>
                <h1 class="sidebar-title">Activate<br>Your Account</h1>
                <p class="sidebar-tagline">New Graduate</p>
                <div class="sidebar-divider"></div>
                <p class="sidebar-description">Your academic records have been pre-loaded from the Registrar's database. Simply confirm your identity and set a password to begin.</p>
            </div>
            <p class="sidebar-quote">"Every ending is a new beginning."</p>
        </div>

        <div class="activation-content">
            <div class="activation-form-wrapper">
                <div class="activation-header">
                    <h2 class="activation-title">Account Activation</h2>
                    <p class="activation-subtitle">Your information was pre-loaded from the school database</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success mb-3">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger mb-3">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('activate.post') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name"
                               class="@error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
                               placeholder="Your full name"
                               required>
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="batch_year">Year Graduated</label>
                        <input type="number" id="batch_year" name="batch_year"
                               class="@error('batch_year') is-invalid @enderror"
                               value="{{ old('batch_year') }}"
                               placeholder="e.g., 2024"
                               min="1900"
                               max="{{ date('Y') }}"
                               required>
                        @error('batch_year') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="course">Course/Program</label>
                        <select id="course" name="course"
                               class="@error('course') is-invalid @enderror"
                               required>
                            <option value="">Select your program</option>
                            <option value="Bachelor of Science in Civil Engineering" {{ old('course') == 'Bachelor of Science in Civil Engineering' ? 'selected' : '' }}>Bachelor of Science in Civil Engineering</option>
                            <option value="Bachelor of Science in Mechanical Engineering" {{ old('course') == 'Bachelor of Science in Mechanical Engineering' ? 'selected' : '' }}>Bachelor of Science in Mechanical Engineering</option>
                            <option value="Bachelor of Science in Electrical Engineering" {{ old('course') == 'Bachelor of Science in Electrical Engineering' ? 'selected' : '' }}>Bachelor of Science in Electrical Engineering</option>
                            <option value="Bachelor of Science in Electronics Engineering" {{ old('course') == 'Bachelor of Science in Electronics Engineering' ? 'selected' : '' }}>Bachelor of Science in Electronics Engineering</option>
                            <option value="Bachelor of Science in Computer Engineering" {{ old('course') == 'Bachelor of Science in Computer Engineering' ? 'selected' : '' }}>Bachelor of Science in Computer Engineering</option>
                            <option value="Bachelor of Science in Computer Science" {{ old('course') == 'Bachelor of Science in Computer Science' ? 'selected' : '' }}>Bachelor of Science in Computer Science</option>
                            <option value="Bachelor of Science in Information Technology" {{ old('course') == 'Bachelor of Science in Information Technology' ? 'selected' : '' }}>Bachelor of Science in Information Technology</option>
                            <option value="Bachelor of Science in Software Engineering" {{ old('course') == 'Bachelor of Science in Software Engineering' ? 'selected' : '' }}>Bachelor of Science in Software Engineering</option>
                            <option value="Bachelor of Science in Accountancy" {{ old('course') == 'Bachelor of Science in Accountancy' ? 'selected' : '' }}>Bachelor of Science in Accountancy</option>
                            <option value="Bachelor of Science in Business Administration" {{ old('course') == 'Bachelor of Science in Business Administration' ? 'selected' : '' }}>Bachelor of Science in Business Administration</option>
                            <option value="Bachelor of Science in Entrepreneurship" {{ old('course') == 'Bachelor of Science in Entrepreneurship' ? 'selected' : '' }}>Bachelor of Science in Entrepreneurship</option>
                            <option value="Bachelor of Science in Financial Management" {{ old('course') == 'Bachelor of Science in Financial Management' ? 'selected' : '' }}>Bachelor of Science in Financial Management</option>
                            <option value="Bachelor of Science in Marketing Management" {{ old('course') == 'Bachelor of Science in Marketing Management' ? 'selected' : '' }}>Bachelor of Science in Marketing Management</option>
                            <option value="Bachelor of Science in Human Resource Management" {{ old('course') == 'Bachelor of Science in Human Resource Management' ? 'selected' : '' }}>Bachelor of Science in Human Resource Management</option>
                            <option value="Bachelor of Science in Nursing" {{ old('course') == 'Bachelor of Science in Nursing' ? 'selected' : '' }}>Bachelor of Science in Nursing</option>
                            <option value="Doctor of Medicine" {{ old('course') == 'Doctor of Medicine' ? 'selected' : '' }}>Doctor of Medicine</option>
                            <option value="Bachelor of Science in Pharmacy" {{ old('course') == 'Bachelor of Science in Pharmacy' ? 'selected' : '' }}>Bachelor of Science in Pharmacy</option>
                            <option value="Bachelor of Science in Medical Technology" {{ old('course') == 'Bachelor of Science in Medical Technology' ? 'selected' : '' }}>Bachelor of Science in Medical Technology</option>
                            <option value="Bachelor of Science in Physical Therapy" {{ old('course') == 'Bachelor of Science in Physical Therapy' ? 'selected' : '' }}>Bachelor of Science in Physical Therapy</option>
                            <option value="Doctor of Dental Medicine" {{ old('course') == 'Doctor of Dental Medicine' ? 'selected' : '' }}>Doctor of Dental Medicine</option>
                        </select>
                        @error('course') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="student_id">Student ID</label>
                        <input type="text" id="student_id" name="student_id"
                               class="@error('student_id') is-invalid @enderror"
                               value="{{ old('student_id') }}"
                               placeholder="Your student ID"
                               required>
                        @error('student_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email"
                               class="@error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               placeholder="your@school.edu.ph"
                               required>
                        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="password">Create Password</label>
                            <input type="password" id="password" name="password"
                                   class="@error('password') is-invalid @enderror"
                                   placeholder="Min. 8 characters"
                                   required>
                            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   placeholder="Re-enter password"
                                   required>
                        </div>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" id="terms" name="terms" class="form-check-input" required>
                        <label class="form-check-label" for="terms">
                            I agree to the Terms of Service & Privacy Policy
                        </label>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('login') }}" class="btn-back">← Back to Login</a>
                        <button type="submit" class="btn-activate">Activate Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
