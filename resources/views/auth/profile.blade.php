@extends('layouts.app')
@section('main-content')
    <div class="container-fluid">

        <div class="row justify-content-center">

            <!-- Profile Card -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body text-center">

                        <!-- Avatar -->
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" class="rounded-circle mb-3"
                            width="80">

                        <!-- Name -->
                        <h3 class="font-weight-bold">{{ auth()->user()->name }}</h3>

                        <!-- Email -->
                        <p class="text-muted">{{ auth()->user()->email }}</p>

                        <!-- Role -->
                        <p class="text-muted mb-3">
                            <i class="fas fa-user-tag"></i>
                            {{ auth()->user()->role }}
                        </p>

                        <!-- Phone -->
                        <p class="text-muted mb-2">
                            <i class="fas fa-phone"></i>
                            {{ auth()->user()->phone ?? 'No phone number' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Update Form -->
            <div class="col-12 mt-3">
                <div class="card shadow">
                    <div class="card-body">

                        <h4 class="mb-4">Update Doctor Profile</h4>

                        <form method="POST" action="#">
                            @csrf

                            <!-- Doctor Code -->
                            <div class="mb-3">
                                <label class="form-label">Doctor Code <span class="text-danger">*</span></label>
                                <input type="text" name="doctor_code" class="form-control" value="{{ $doctor->doctor_code }}" required>
                            </div>

                            <!-- Full Name -->
                            <div class="mb-3">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ $doctor->name }}" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ $doctor->email }}" required>
                            </div>

                            <!-- Phone -->
                            <div class="mb-3">
                                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" value="{{ $doctor->phone }}" required>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between">

                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>

                                <a href="#" class="btn btn-secondary">
                                    Cancel
                                </a>

                            </div>

                        </form>

                    </div>
                </div>
            </div>
        @endsection
