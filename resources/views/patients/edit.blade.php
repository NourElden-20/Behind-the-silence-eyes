
@extends('layouts.app')

@section('main-content')

{{-- Back Button --}}
<a href="{{ route('patients.index') }}" class="btn btn-link text-dark mb-2 pl-0">
    <i class="fas fa-arrow-left mr-2"></i> Back to Patients
</a>

{{-- Page Title --}}
<h4 class="font-weight-bold mb-1">Edit Patient</h4>
<p class="text-muted mb-4">Update the patient information below</p>

{{-- Edit Form Card --}}
<div class="card shadow mb-4 border-0 rounded-lg">
    <div class="card-body py-4 px-4">

        <form action="{{ route('patients.update', $patient->id) }}" method="POST">
            @csrf
            @method('post')

            {{-- Personal Information --}}
            <h6 class="font-weight-bold mb-3">Personal Information</h6>
            <hr class="mt-0">

            {{-- Full Name --}}
            <div class="form-group">
                <label class="font-weight-bold">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control rounded-lg" placeholder="Enter patient's full name"
                    value="{{ old('name', $patient->name) }}" required>
            </div>

            <div class="row">
                {{-- National ID --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">National ID <span class="text-danger">*</span></label>
                        <input type="text" name="national_id" class="form-control rounded-lg"
                            placeholder="Enter national ID" value="{{ old('national_id', $patient->national_id) }}"
                            required>
                    </div>
                </div>
                {{-- Date of Birth --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" name="date_of_birth" class="form-control rounded-lg"
                            value="{{ old('date_of_birth', \Carbon\Carbon::parse($patient->date_of_birth)->format('Y-m-d')) }}"
                            required>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- Age --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Age <span class="text-danger">*</span></label>
                        <input type="number" name="age" class="form-control rounded-lg" placeholder="Enter age"
                            value="{{ old('age', $patient->age) }}" required>
                    </div>
                </div>
                {{-- Gender --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">Gender <span class="text-danger">*</span></label>
                        <select name="gender" class="form-control rounded-lg" required>
                            <option value="male" {{ $patient->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $patient->gender == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Medical Information --}}
            <h6 class="font-weight-bold mb-3 mt-3">Medical Information</h6>
            <hr class="mt-0">

            {{-- Medical History --}}
            <div class="form-group">
                <label class="font-weight-bold">Medical History</label>
                <textarea name="medical_history" class="form-control rounded-lg" rows="4"
                    placeholder="Enter patient's medical history, existing conditions, allergies, etc.">{{ old('medical_history', $patient->medical_history) }}</textarea>
            </div>

            {{-- Buttons --}}
            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('patients.show', $patient->id) }}"
                    class="btn btn-light font-weight-bold px-4 mr-2 rounded-lg">
                    Cancel
                </a>
              
                <button type="submit" class="btn text-white font-weight-bold px-4 rounded-lg"
                    style="background:#2563eb;">
                    <i class="fas fa-save mr-2"></i> Save Changes
                </button>
            </div>
         

        </form>

    </div>
</div>

@endsection
