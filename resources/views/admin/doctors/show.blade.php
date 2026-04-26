@extends('layouts.app')
@section('main-content')
    {{-- Back Button --}}
    <a href="{{ route('doctors.index') }}" class="btn btn-link text-dark mb-4 pl-0">
        <i class="fas fa-arrow-left mr-2"></i> Back to Doctors
    </a>

    {{-- doctor Info Card --}}
    <div class="card shadow mb-4 border-0 rounded-lg">
        <div class="card-body py-4 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mr-3"
                        style="width:65px; height:65px; background:#dbeafe !important;">
                        <i class="fas fa-user fa-2x" style="color:#2563eb;"></i>
                    </div>
                    <div>
                        <h4 class="font-weight-bold mb-1">{{ $doctor->name }}</h4>
                    </div>
                </div>
                <div class="d-flex">
                    <a href="{{ route('doctors.edit', $doctor->id) }}"
                        class="btn text-white font-weight-bold px-4 py-2 mr-2"
                        style="background:#f97316; border-radius:10px;">
                        <i class="fas fa-edit mr-2"></i> Edit Doctor
                    </a>
                </div>
            </div>

            <hr>


            <div class="row mt-2">
                <div class="col-md-6 mb-3">
                    <p class="text-muted mb-1">
                        <i class="fas fa-hashtag mr-2"></i> Doctor_code
                    </p>
                    <p class="font-weight-bold mb-0">{{ $doctor->doctor_code }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <p class="text-muted mb-1">
                        <i class="fas fa-calendar-check mr-2"></i> Registered On
                    </p>
                    <p class="font-weight-bold mb-0">{{ \Carbon\Carbon::parse($doctor->created_at)->format('d/m/Y') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="text-muted mb-1">
                        <i class="fas fa-envelope mr-2"></i> Email
                    </p>
                    <p class="font-weight-bold mb-0">{{ $doctor->email }}
                    </p>
                </div>
                
                <div class="col-md-6 mb-3">
                    <p class="text-muted mb-1">
                        <i class="fas fa-phone mr-2"></i> Phone
                    </p>
                    <p class="font-weight-bold mb-0">{{ $doctor->phone }}</p>
                </div>
                <div class="col-md-12 mb-3">
                    <p class="text-muted mb-1">
                        <i class="fas fa-star mr-2"></i> Role
                    </p>
                    <p class="font-weight-bold mb-0">{{ $doctor->role }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
