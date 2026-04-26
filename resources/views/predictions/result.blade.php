@extends('layouts.app')

@section('main-content')
<div class="container-fluid py-4">

    {{-- Back Button --}}
    <a href="{{ route('patients.show', $prediction->patient->id) }}"
        class="text-decoration-none text-secondary d-inline-flex align-items-center gap-1 mb-3">
        <i class="fas fa-arrow-left"></i> Back to Patient Profile
    </a>

    <h4 class="fw-bold mb-1">Diagnosis Result</h4>
    <p class="text-muted mb-4">Patient: {{ $prediction->patient->name }}</p>

    <div class="row">

        {{-- Left Column --}}
        <div class="col-md-6">

            {{-- Result Card --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">AI Diagnosis Result</h6>

                    {{-- Disease Type --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Disease Type</span>
                        <span class="badge bg-primary fs-6">{{ ucfirst($prediction->disease_type) }}</span>
                    </div>

                    {{-- Severity --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Severity</span>
                        <span class="fw-bold">{{ $prediction->severity ?? 'N/A' }}</span>
                    </div>

                    {{-- Confidence --}}
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Confidence</span>
                            <span class="fw-bold">{{ number_format($prediction->confidence, 1) }}%</span>
                        </div>
                        <div class="progress" style="height:10px;">
                            <div class="progress-bar bg-primary"
                                style="width: {{ $prediction->confidence }}%"></div>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Status</span>
                        @if($prediction->status == 'completed')
                            <span class="badge bg-success">Completed</span>
                        @elseif($prediction->status == 'failed')
                            <span class="badge bg-danger">Failed</span>
                        @else
                            <span class="badge bg-warning text-dark">Pending</span>
                        @endif
                    </div>

                    {{-- Date --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Date</span>
                        <span>{{ $prediction->created_at->format('d M Y') }}</span>
                    </div>

                </div>
            </div>

            {{-- Notes --}}
            @if($prediction->notes)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-2">Doctor Notes</h6>
                    <p class="text-muted mb-0">{{ $prediction->notes }}</p>
                </div>
            </div>
            @endif

            {{-- Generate Report --}}
            <form action="{{ route('reports.generate', $prediction->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                    <i class="fas fa-file-pdf me-2"></i> Generate PDF Report
                </button>
            </form>

        </div>

        {{-- Right Column - Image --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Retinal Image</h6>
                    <img src="{{ asset('storage/' . $prediction->image_path) }}"
                        class="img-fluid rounded w-100"
                        alt="Retinal Image">

                    <hr>

                    {{-- Patient Info --}}
                    <h6 class="fw-bold mb-3">Patient Info</h6>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Name</span>
                        <span>{{ $prediction->patient->name }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Age</span>
                        <span>{{ $prediction->patient->age }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Gender</span>
                        <span>{{ ucfirst($prediction->patient->gender) }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Doctor</span>
                        <span>{{ $prediction->doctor->name }}</span>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>
@endsection