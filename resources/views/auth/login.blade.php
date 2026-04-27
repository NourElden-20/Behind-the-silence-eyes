@extends('layouts.auth')

@section('content')
    {{-- إزالة Fixed تماماً واستخدام Flex بمرونة للسماح بالسكرول --}}
    <div class="min-vh-100 w-100 d-flex flex-column align-items-center py-5"
        style=" overflow-y: auto;">

        {{-- Logo & Header --}}
        <div class="text-center mb-4">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow"
                style="width:72px;height:72px; background:#1a56db;">
                <svg width="34" height="34" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M1.5 12S5.25 4.5 12 4.5 22.5 12 22.5 12 18.75 19.5 12 19.5 1.5 12 1.5 12z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
            </div>
            <h1 class="fw-bold mb-1" style="color:#0f172a;">Behind the Silent Eyes</h1>
            <p style="color:#475569;">AI-Powered Eye Disease Diagnosis System</p>
        </div>

        {{-- Main Card (Doctor Only) --}}
        <div class="card border-0 p-4 p-md-5 w-100 mb-4"
            style="max-width:500px; border-radius:20px; box-shadow: 0 15px 35px rgba(0,0,0,0.1);">
            
            <h2 class="fw-bold mb-4 text-center" style="color:#0f172a;">Doctor Login</h2>

            @if (session('error'))
                <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-bold small">Email Address</label>
                    <div class="input-group border rounded-3 overflow-hidden">
                        <span class="input-group-text bg-white border-0"><i class="bi bi-envelope text-secondary"></i></span>
                        <input type="email" name="email" class="form-control border-0 shadow-none @error('email') is-invalid @enderror" placeholder="doctor@hospital.com" value="{{ old('email') }}">
                    </div>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small">Password</label>
                    <div class="input-group border rounded-3 overflow-hidden">
                        <span class="input-group-text bg-white border-0"><i class="bi bi-lock text-secondary"></i></span>
                        <input type="password" name="password" class="form-control border-0 shadow-none @error('password') is-invalid @enderror" placeholder="••••••••">
                    </div>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label small text-secondary" for="remember">Remember me</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-decoration-none small fw-bold" style="color:#1a56db;">Forgot?</a>
                </div>

                <button type="submit" class="btn w-100 py-2 fw-bold text-white shadow-sm"
                    style="background:#1a56db; border-radius:10px;">
                    Sign In
                </button>
            </form>
        </div>

        {{-- Patient Section (خارج الكارد تماماً لضمان عدم التداخل) --}}
        <div class="w-100 text-center" style="max-width:500px;">
            <div class="d-flex align-items-center mb-3">
                <hr class="flex-grow-1">
                <span class="mx-3 text-secondary small fw-bold">ARE YOU A PATIENT?</span>
                <hr class="flex-grow-1">
            </div>
            
            <a href="{{ route('patient.login') }}" 
               class="btn btn-white w-100 py-2 fw-bold shadow-sm" 
               style="border-radius:10px; border: 2px solid #1a56db; color: #1a56db; background: white;">
                <i class="bi bi-person-badge me-2"></i> Access with National ID
            </a>
        </div>

        <footer class="text-center mt-5" style="color:#475569;">
            <small>&copy; 2026 Behind the Silent Eyes.</small>
        </footer>
        
    </div>
@endsection