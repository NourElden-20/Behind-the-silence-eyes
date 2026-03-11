{{-- resources/views/patients/create.blade.php --}}
{{-- All Done --}}
@extends('layouts.app')

@section('main-content')


    <div class="flex-grow-1 ">
        <div class="mx-auto" style="max-width: 900px;">

            {{-- Back to Patients --}}
            <a href="{{ route('patients.index') }}"
                class="text-decoration-none text-secondary d-inline-flex align-items-center gap-1 mb-3"
                style="font-size: 1rem;">
                <i class="fas fa-fw  fa-arrow-left"></i> Back to Patients
            </a>

            <!-- Page Title -->
            <h5 class="fw-bold mb-1" style="color: #1a1a2e;">Add New Patient</h5>
            <p class="text-muted mb-4" style="font-size: 1rem;">
                Fill in the patient information below
            </p>

            <!-- Errors -->
            

            <!-- Card -->
            <div class="bg-white rounded border p-4">

                {{-- Form for create patient --}}
                <form action="{{ route('patients.store') }}" method="POST">
                    @csrf

                    <!-- Personal Information Section -->
                    <p class="fw-bold mb-3 pb-2 border-bottom" style="font-size: 2rem; color: #020240;">
                        Personal Information
                    </p>

                    <!-- Full Name -->
                    <div class="mb-3">
                        <label class="form-label fw-medium" style="font-size: 0.85rem;">
                            Full Name <span class="text-danger">*</span>
                        </label>

                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Enter patient's full name" value="{{ old('name') }}">

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- National ID & Date of Birth -->
                    <div class="row g-3 mb-3">

                        <div class="col-md-6">
                            <label class="form-label fw-medium" style="font-size: 0.85rem;">
                                National ID <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="national_id"
                                class="form-control @error('national_id') is-invalid @enderror"
                                placeholder="Enter national ID" value="{{ old('national_id') }}">

                            @error('national_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium" style="font-size: 0.85rem;">
                                Date of Birth <span class="text-danger">*</span>
                            </label>

                            <input type="date" name="date_of_birth"
                                class="form-control @error('date_of_birth') is-invalid @enderror"
                                value="{{ old('date_of_birth') }}">

                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Age & Gender -->
                    <div class="row g-3 mb-4">

                        <div class="col-md-6">
                            <label class="form-label fw-medium" style="font-size: 0.85rem;">
                                Age <span class="text-danger">*</span>
                            </label>

                            <input type="number" name="age" class="form-control @error('age') is-invalid @enderror"
                                placeholder="Enter age" value="{{ old('age') }}">

                            @error('age')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium" style="font-size: 0.85rem;">
                                Gender <span class="text-danger">*</span>
                            </label>

                            <select name="gender" class="form-select @error('gender') is-invalid @enderror">

                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>
                                    Male
                                </option>

                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                    Female
                                </option>

                            </select>

                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Medical Information Section -->
                    <p class="fw-semibold mb-3 pb-2 border-bottom" style="font-size: 0.95rem; color: #1a1a2e;">
                        Medical Information
                    </p>

                    <!-- Medical History -->
                    <div class="mb-4">

                        <label class="form-label fw-medium" style="font-size: 0.85rem;">
                            Medical History
                        </label>

                        <textarea name="medical_history" class="form-control @error('medical_history') is-invalid @enderror" rows="4"
                            placeholder="Enter patient's medical history, existing conditions, allergies, etc.">{{ old('medical_history') }}</textarea>

                        @error('medical_history')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="form-text" style="font-size: 0.78rem;">
                            Include any relevant medical conditions, previous diagnoses, or ongoing treatments
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">

                        <button type="submit" class="btn btn-primary d-flex align-items-center"
                            style="font-size: 0.88rem; background-color: #1a3a8f; border-color: #1a3a8f;">
                            <i class="bi bi-person-plus-fill"></i>
                            Save Patient
                        </button>

                        {{-- Cancel return to home page --}}
                        <a href="{{route('patients.index')}}" class="btn btn-outline-secondary " style="font-size: 0.88rem;">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
