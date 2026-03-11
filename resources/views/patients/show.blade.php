
@extends('layouts.app')

@section('main-content')

{{-- Back Button --}}
<a href="{{ route('patients.index') }}" class="btn btn-link text-dark mb-4 pl-0">
    <i class="fas fa-arrow-left mr-2"></i> Back to Patients
</a>

{{-- Patient Info Card --}}
<div class="card shadow mb-4 border-0 rounded-lg">
    <div class="card-body py-4 px-4">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mr-3"
                    style="width:65px; height:65px; background:#dbeafe !important;">
                    <i class="fas fa-user fa-2x" style="color:#2563eb;"></i>
                </div>
                <div>
                    <h4 class="font-weight-bold mb-1">{{ $patient->name }}</h4>
                    <span class="text-muted">{{ $patient->age }} years • {{ ucfirst($patient->gender) }}</span>
                </div>
            </div>
            <div class="d-flex">
                <a href="{{ route('patients.edit', $patient->id) }}"
                    class="btn text-white font-weight-bold px-4 py-2 mr-2"
                    style="background:#f97316; border-radius:10px;">
                    <i class="fas fa-edit mr-2"></i> Edit Patient
                </a>
                <a href="{{ route('predictions.create', $patient->id) }}"
                    class="btn text-white font-weight-bold px-4 py-2" style="background:#2563eb; border-radius:10px;">
                    <i class="fas fa-eye mr-2"></i> New Diagnosis
                </a>
            </div>
        </div>

        <hr>


        <div class="row mt-2">
            <div class="col-md-6 mb-3">
                <p class="text-muted mb-1">
                    <i class="fas fa-hashtag mr-2"></i> National ID
                </p>
                <p class="font-weight-bold mb-0">{{ $patient->national_id }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <p class="text-muted mb-1">
                    <i class="fas fa-heartbeat mr-2"></i> Medical History
                </p>
                <p class="font-weight-bold mb-0">{{ $patient->medical_history ?? 'No significant history' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <p class="text-muted mb-1">
                    <i class="fas fa-calendar mr-2"></i> Date of Birth
                </p>
                <p class="font-weight-bold mb-0">{{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d/m/Y') }}
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <p class="text-muted mb-1">
                    <i class="fas fa-calendar-check mr-2"></i> Registered On
                </p>
                <p class="font-weight-bold mb-0">{{ \Carbon\Carbon::parse($patient->created_at)->format('d/m/Y') }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Diagnosis History --}}
<div class="card shadow border-0 rounded-lg mb-4">
    <div class="card-body px-4 py-4">
        <h5 class="font-weight-bold mb-4">Diagnosis History</h5>
        <div class="table-responsive">
            <table class="table table-borderless">
                <thead>
                    <tr class="text-uppercase text-muted small">
                        <th>Date</th>
                        <th>Disease Type</th>
                        <th>Severity</th>
                        <th>Confidence</th>
                        <th>Notes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patient->predictions as $prediction)
                    <tr class="align-middle">
                        <td>{{ \Carbon\Carbon::parse($prediction->created_at)->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge px-3 py-2 rounded-pill"
                                style="background:#dbeafe; color:#2563eb; font-size:0.85rem;">
                                {{ ucfirst($prediction->disease_type) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge px-3 py-2 rounded-pill"
                                style="background:#dcfce7; color:#16a34a; font-size:0.85rem;">
                                {{ $prediction->severity ?? '-' }}
                            </span>
                        </td>
                        <td>{{ $prediction->confidence }}%</td>
                        <td>{{ \Illuminate\Support\Str::limit($prediction->notes, 40) }}</td>
                        <td>
                            <a href="{{ route('predictions.report', $prediction->id) }}"
                                class="text-primary font-weight-bold">
                                <i class="fas fa-file-alt mr-1"></i> Report
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No diagnoses yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection