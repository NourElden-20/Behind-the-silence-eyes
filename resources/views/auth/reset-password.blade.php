@extends('layouts.auth')

@section('content')
    <div class="min-vh-100 w-100 d-flex flex-column align-items-center justify-content-center px-3"
        style="background:#e2eef9; position:fixed; top:0; left:0;">

        <div class="rounded-circle d-flex align-items-center justify-content-center mb-3 shadow"
            style="width:72px;height:72px; background:#1a56db;">
            <svg width="34" height="34" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                <path d="M1.5 12S5.25 4.5 12 4.5 22.5 12 22.5 12 18.75 19.5 12 19.5 1.5 12 1.5 12z" />
                <circle cx="12" cy="12" r="3" />
            </svg>
        </div>

        <h1 class="fw-bold mb-1" style="color:#0f172a;">Behind the Silent Eyes</h1>
        <p class="mb-4" style="color:#475569;">AI-Powered Eye Disease Diagnosis System</p>

        <div class="card border-0 p-5 w-100"
            style="max-width:540px; border-radius:20px; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">

            <h2 class="fw-bold mb-2" style="color:#0f172a;">Reset Password</h2>
            <p class="mb-4 text-secondary" style="font-size:0.95rem;">
                Enter your new password below.
            </p>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success rounded-3">{{ session('success') }}</div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
                <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
            @endif

            <form action="{{ route('password.update') }}" method="POST">
                @csrf

                {{-- Token --}}
                <input type="hidden" name="token" value="{{ $token }}">

                {{-- Email --}}
                <div class="mb-4">
                    <label class="form-label fw-bold" style="color:#0f172a;">Email Address</label>
                    <div class="input-group border overflow-hidden"
                        style="border-color:#cbd5e1 !important; border-radius:12px;">
                        <span class="input-group-text bg-white border-0 ps-3 pe-2">
                            <i class="bi bi-envelope fs-5 text-secondary"></i>
                        </span>
                        <input type="email" name="email"
                            class="form-control bg-white border-0 shadow-none ps-1 @error('email') is-invalid @enderror"
                            placeholder="doctor@hospital.com"
                            value="{{ old('email', request('email')) }}">
                    </div>
                    @error('email')
                        <div class="text-danger mt-1" style="font-size:0.85rem;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- New Password --}}
                <div class="mb-4">
                    <label class="form-label fw-bold" style="color:#0f172a;">New Password</label>
                    <div class="input-group border overflow-hidden"
                        style="border-color:#cbd5e1 !important; border-radius:12px;">
                        <span class="input-group-text bg-white border-0 ps-3 pe-2">
                            <i class="bi bi-lock fs-5 text-secondary"></i>
                        </span>
                        <input type="password" name="password"
                            class="form-control bg-white border-0 shadow-none ps-1 @error('password') is-invalid @enderror"
                            placeholder="Enter new password">
                    </div>
                    @error('password')
                        <div class="text-danger mt-1" style="font-size:0.85rem;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-4">
                    <label class="form-label fw-bold" style="color:#0f172a;">Confirm Password</label>
                    <div class="input-group border overflow-hidden"
                        style="border-color:#cbd5e1 !important; border-radius:12px;">
                        <span class="input-group-text bg-white border-0 ps-3 pe-2">
                            <i class="bi bi-lock-fill fs-5 text-secondary"></i>
                        </span>
                        <input type="password" name="password_confirmation"
                            class="form-control bg-white border-0 shadow-none ps-1"
                            placeholder="Confirm new password">
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="w-100 py-2 fw-bold fs-5 border-0 text-white mt-2"
                    style="background:#1a56db; border-radius:12px;">
                    Reset Password
                </button>

                {{-- Back to Login --}}
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none"
                        style="color:#1a56db; font-size:0.9rem;">
                        Back to Login
                    </a>
                </div>

            </form>
        </div>

        <footer class="text-center mt-4 pb-3" style="color:#475569;">
            <small>&copy; 2026 Behind the Silent Eyes. All rights reserved.</small>
        </footer>

    </div>
@endsection