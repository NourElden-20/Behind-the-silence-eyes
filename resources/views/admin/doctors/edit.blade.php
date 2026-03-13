@extends('layouts.app')
@section('main-content')

    {{-- Back Button --}}
    <a href="{{ route('doctors.index') }}" class="btn btn-link text-dark mb-2 pl-0">
        <i class="fas fa-arrow-left mr-2"></i> Back to Doctors
    </a>

    {{-- Page Title --}}
    <h4 class="font-weight-bold mb-1">Edit Doctor</h4>
    <p class="text-muted mb-4">Update the doctor information below</p>

    {{-- Edit Form Card --}}
    <div class="card shadow mb-4 border-0 rounded-lg">
        <div class="card-body py-4 px-4">

            <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
                @csrf
                @method('post')

                {{-- Personal Information --}}
                <h6 class="font-weight-bold mb-3">Personal Information</h6>
                <hr class="mt-0">

                {{-- Full Name --}}
                <div class="form-group">
                    <label class="font-weight-bold">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control rounded-lg" placeholder="Enter doctor's full name"
                        value="{{ old('name', $doctor->name) }}" required>
                </div>

                <div class="row">
                    {{-- National ID --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">National ID <span class="text-danger">*</span></label>
                            <input type="text" name="national_id" class="form-control rounded-lg"
                                placeholder="Enter national ID" value="{{ old('national_id', $doctor->national_id) }}"
                                required>
                        </div>
                    </div>
                    {{-- Date of Birth --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" name="date_of_birth" class="form-control rounded-lg"
                                value="{{ old('date_of_birth', \Carbon\Carbon::parse($doctor->date_of_birth)->format('Y-m-d')) }}"
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
                                value="{{ old('age', $doctor->age) }}" required>
                        </div>
                    </div>
                    {{-- Gender --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-control rounded-lg" required>
                                <option value="male" {{ $doctor->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $doctor->gender == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('doctors.show', $doctor->id) }}"
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