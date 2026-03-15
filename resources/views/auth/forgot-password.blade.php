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
            style="max-width:540px; border-radius:20px; box-shadow: 0 20px 60px rgba(0,0,0,0.15), 0 6px 20px rgba(26,86,219,0.1);">
            <h2 class="fw-bold mb-2" style="color:#0f172a;">Forget Password</h2>
            <p class="mb-4 text-secondary" style="font-size:0.95rem;">
                Please enter your email address to receive the verification code.
            </p>

            @if(session('error'))
                <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
            @endif

            <form action="">
                @csrf

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
                            placeholder="doctor@hospital.com" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Success Message -->
                <div id="successMessage" class="alert alert-success d-none mt-3 rounded-3">
                    Verification email sent successfully.
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-100 py-2 fw-bold fs-5 border-0 text-white mt-2"
                    style="background:#1a56db; border-radius:12px;">Send Verification Email</button>


            </form>
        </div>



        <footer class="text-center mt-4 pb-3" style="color:#475569;">
            <small>&copy; 2026 Behind the Silent Eyes. All rights reserved.</small>
        </footer>

    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function (e) {
            e.preventDefault(); // يمنع الإرسال الفعلي
            document.getElementById('successMessage').classList.remove('d-none');
        });
    </script>
@endsection