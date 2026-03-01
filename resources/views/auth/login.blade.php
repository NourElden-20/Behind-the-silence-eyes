@extends('layouts.auth')

@section('content')
<div class="row justify-content-center bg-light">
    <div class="col-xl-6 col-lg-6 col-md-6">
        <div class="text-center">
        <h1 class="  mb-8">Behind the Silent Eyes</h1>
        <h4 >AI-Powered Eye Disease Diagnosis System</h4>
        </div>
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">

                            <div class="">
                                <h1 class="h4 text-dark mb-4">Doctor Login</h1>
                            </div>

                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <form class="user" action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <span class="text-dark">Email Address</span>
                                    <input type="email" name="email"
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        placeholder="&#xf0e0; Docotr@hospital.com"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <span class="text-dark">Password</span>
                                    <input type="password" name="password"
                                        class="form-control form-control-user @error('password') is-invalid @enderror"
                                        placeholder="&#xf070;Enter Your Password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="p-6">
                                    <input type="checkbox" name="remeber me" id=""> <span>remeber me</span>
                                    <a href="">Forgot Password</a>
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection