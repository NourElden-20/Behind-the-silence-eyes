{{-- الفورم الى بتعمل انشاء دكتور --}}
@extends('layouts.app')
@section('main-content')
    <div class="flex-grow-1">
        <div class="mx-auto" style="max-width: 900px;">

            <a href="{{ route('doctors.index') }}"
                class="text-decoration-none text-secondary d-inline-flex align-items-center gap-1 mb-3"
                style="font-size: 1rem;">
                <i class="fas fa-fw fa-arrow-left"></i> Back to Doctors List
            </a>

            <h5 class="fw-bold mb-1" style="color: #1a1a2e;">Add New Doctor</h5>
            <p class="text-muted mb-4" style="font-size: 1rem;">
                Fill in the Doctor information below
            </p>

            <form action="{{ route('doctors.store') }}" method="POST">
                @csrf
                <div class="bg-white rounded border p-4">

                    <p class="fw-bold mb-3 pb-2 border-bottom" style="font-size: 2rem; color: #020240;">
                        Personal Information
                    </p>

                    <!-- Doctor Code -->
                    <div class="mb-3">
                        <label class="form-label fw-medium" style="font-size: 0.85rem;">
                            Doctor Code <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="doctor_code"
                            class="form-control @error('doctor_code') is-invalid @enderror"
                            placeholder="Enter Doctor Code" value="{{ old('doctor_code') }}">
                        @error('doctor_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Full Name -->
                    <div class="mb-3">
                        <label class="form-label fw-medium" style="font-size: 0.85rem;">
                            Full Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Enter Doctor full name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-3">
                        <label class="form-label fw-medium" style="font-size: 0.85rem;">
                            Phone Number <span class="text-danger">*</span>
                        </label>
                        <input type="number" name="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            placeholder="Enter Phone Number" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label fw-medium" style="font-size: 0.85rem;">
                            Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password & Role -->
                    <div class="row mb-3">
                        <!-- Password -->
                        <div class="col-md-6">
                            <label class="form-label fw-medium" style="font-size: 0.85rem;">
                                Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="col-md-6">
                            <label class="form-label fw-medium" style="font-size: 0.85rem;">
                                Role <span class="text-danger">*</span>
                            </label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror">
                                <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary d-flex align-items-center"
                            style="font-size: 0.88rem; background-color: #1a3a8f; border-color: #1a3a8f;">
                            <i class="bi bi-person-plus-fill me-1"></i>
                            Save Doctor
                        </button>
                        <a href="{{ route('doctors.index') }}" class="btn btn-outline-secondary"
                            style="font-size: 0.88rem;">
                            Cancel
                        </a>
                    </div>

                </div>
            </form>

        </div>
    </div>
@endsection
