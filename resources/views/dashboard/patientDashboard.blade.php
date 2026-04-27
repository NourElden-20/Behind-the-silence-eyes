@extends('layouts.patient_app')

@section('title', 'My Profile - ')

@section('main-content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Welcome, {{ $patient->name }}</h1>
        <span class="badge badge-primary p-2">Patient Profile</span>
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Personal Information</div>
                            <div class="mb-0 font-weight-bold text-gray-800">
                                <p class="mb-1"><strong>National ID:</strong> {{ $patient->national_id }}</p>
                                <p class="mb-1"><strong>Age:</strong> {{ $patient->age }} Years</p>
                                <p class="mb-1"><strong>Gender:</strong> {{ ucfirst($patient->gender) }}</p>
                                <p class="mb-0"><strong>Phone:</strong> {{ $patient->phone }}</p>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-circle fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Medical History</div>
                    <div class="p text-gray-700">
                        {{ $patient->medical_history ?? 'No medical history recorded.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">My Diagnosis History</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th>Date</th>
                            <th>Diagnosis Type</th>
                            <th>Result</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($predictions as $prediction)
                        <tr>
                            <td>{{ $prediction->created_at->format('Y-m-d H:i') }}</td>
                            <td><span class="badge badge-info">{{ $prediction->type ?? 'Eye Scan' }}</span></td>
                            <td>
                                @if(isset($prediction->result))
                                    <span class="font-weight-bold {{ $prediction->result == 'Normal' ? 'text-success' : 'text-danger' }}">
                                        {{ $prediction->result }}
                                    </span>
                                @else
                                    <span class="text-muted">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if($prediction->report)
                                    <a href="{{ route('reports.show', $prediction->report->id) }}" class="btn btn-sm btn-primary shadow-sm">
                                        <i class="fas fa-file-download fa-sm text-white-50"></i> View Report
                                    </a>
                                @else
                                    <span class="small text-muted">No Report</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="fas fa-folder-open fa-2x mb-2 d-block text-gray-300"></i>
                                No diagnosis records found.
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