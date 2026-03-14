{{-- الفورم الى بتعمل انشاء دكتور --}}

<!-- resources/views/doctors/create.blade.php -->
@extends('layouts.app')
@section('main-content')

    <div class="flex-grow-1 ">
        <div class="mx-auto" style="max-width: 900px;">



            {{-- Back to Doctor List --}}
            {{-- هيروح ل صفحة ال Doc List --}}
            <a href="{{ route('patients.index') }}"
                class="text-decoration-none text-secondary d-inline-flex align-items-center gap-1 mb-3"
                style="font-size: 1rem;">
                <i class="fas fa-fw  fa-arrow-left"></i> Back to Doctors List
            </a>



            <!-- Page Title -->
            <h5 class="fw-bold mb-1" style="color: #1a1a2e;">Add New Doctor</h5>
            <p class="text-muted mb-4" style="font-size: 1rem;">
                Fill in the Doctor information below
            </p>



            <!-- Card -->
            <div class="bg-white rounded border p-4">

                <!-- Personal Information Section -->
                <p class="fw-bold mb-3 pb-2 border-bottom" style="font-size: 2rem; color: #020240;">
                    Personal Information
                </p>


                <!-- Doctor ID -->
                <div class="mb-3">

                    <div class="form-label fw-medium">
                        <label class="form-label" style="font-size: 0.85rem;">
                            Doctor Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="doc_code" placeholder="Enter Doctor Code">
                    </div>
                </div>
                @error('doc_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror


                <!-- Full Name -->
                <div class="mb-3">
                    <label class="form-label fw-medium" style="font-size: 0.85rem;">
                        Full Name <span class="text-danger">*</span>
                    </label>

                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Enter Doctor full name" value="{{ old('name') }}">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror



                    <!-- Phone Number -->
                    <div class="mb-3">
                        <div class="form-label fw-medium">
                            <label class="form-label" style="font-size: 0.85rem;">
                                Phone Number <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="phone" placeholder="Enter Phone Number">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <!-- Email-->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email">
                        </div>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password & Role-->
                    <div class="row mb-3">


                        <!-- Password -->
                        <div class="col-md-6">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password">
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror


                        <!-- Role -->
                        <div class="col-md-6">
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-select">
                                <option value="">Select Role</option>
                                <option value="doctor">Doctor</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">

                        <button type="submit" class="btn btn-primary d-flex align-items-center"
                            style="font-size: 0.88rem; background-color: #1a3a8f; border-color: #1a3a8f;">
                            <i class="bi bi-person-plus-fill"></i>
                            Save Doctor
                        </button>

                        {{-- Cancel return to Dashboard --}}
                        <a href="#" class="btn btn-outline-secondary "
                            style="font-size: 0.88rem;">
                            Cancel
                        </a>
                    </div>


                        {{-- عايزين Validate ان لما يتداس ع زرار ال Save والفورم فاضيه يقولو لازم تملأ الفورم --}}



                    </form>

                </div>
            </div>
        </div>
@endsection