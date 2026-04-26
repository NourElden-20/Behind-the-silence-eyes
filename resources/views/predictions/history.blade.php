@extends('layouts.app')

@section('main-content')
    <div class="container-fluid py-4">

        {{-- Back Button --}}
        <a href="{{ route('patients.show', $patient->id) }}"
            class="text-decoration-none text-secondary d-inline-flex align-items-center gap-1 mb-3">
            <i class="fas fa-arrow-left"></i> Back to Patient Profile
        </a>
        {{-- Title --}}
        <h4 class="fw-bold mb-4">Prediction History</h4>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Disease</th>
                                <th>Severity</th>
                                <th>Confidence</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($predictions as $prediction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    {{-- Image --}}
                                    <td>
                                        <img src="{{ asset('storage/' . $prediction->image_path) }}" class="rounded"
                                            style="width:70px; height:70px; object-fit:cover;">
                                    </td>
                                    {{-- Disease --}}
                                    <td class="fw-bold text-capitalize">
                                        {{ $prediction->disease_type }}
                                    </td>
                                    {{-- Severity --}}
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $prediction->severity ?? '-' }}
                                        </span>
                                    </td>
                                    {{-- Confidence --}}
                                    <td>
                                        <span class="fw-bold text-success">
                                            {{ $prediction->confidence }}%
                                        </span>
                                    </td>
                                    {{-- Status --}}
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $prediction->status }}
                                        </span>
                                    </td>
                                    {{-- Date --}}
                                    <td>
                                        {{ $prediction->created_at->format('Y-m-d') }}
                                    </td>
                                    {{-- Action --}}
                                    <td class="text-center">
                                        {{-- View Button --}}
                                        <a href="{{ route('predictions.result', $prediction->id) }}"
                                            class="btn btn-md btn-outline-primary me-1">
                                            View
                                        </a>
                                        {{-- Report Button --}}
                                        <a href="{{ route('reports.generate', $prediction->id) }}"
                                            class="btn btn-md btn-outline-success">
                                            Report
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-muted py-4">
                                        No predictions found
                                    </td>
                                    <td>
                                        <button class="btn btn-md btn-outline-primary me-1">
                                            View
                                        </button>
                                        <button class="btn btn-md btn-outline-success">
                                            Report
                                        </button>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
