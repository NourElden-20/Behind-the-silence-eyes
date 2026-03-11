@extends('layouts.app')

@section('main-content')
    <div class="row justify-content-between pb-2">
        <div class="col-6">
            <div class="search-container">
                <input type="text" class="form-control search-input " placeholder="Search by national ID...">
            </div>
        </div>
        <div class="">
            <a href="{{ route('patients.create') }}" class="btn btn-primary active" role="button" aria-pressed="true">+ Add New Patient</a>

        </div>
    </div>

    <div class="row justify-content-around">

        @foreach ($allPatients as $patient)
            <div class="card border-dark col-lg-6  mt-2" style="max-width: 18rem;">
                <div class="card-header">{{ $patient->name }}
                    <div class="d-flex">
                        <h6 class="">{{ $patient->age }} years.</h6>
                        <h6 class="">{{ $patient->gender }}</h6>
                    </div>
                </div>
                <div class="card-body text-dark ">
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title">National ID:</h6>
                        <h6 class="card-title">{{ $patient->national_id }}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title">Date of Birth:</h6>
                        <h6 class="card-title">{{ $patient->date_of_birth }}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="card-title">disease_type:</h6>
                        <h6 class="card_title">{{ $patient->prediction?->disease_type }}</h6>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between ">
                        <a href="{{ route('patients.show', $patient->id) }}"class="btn btn-outline-primary">View</a>
                        <a
                            href="{{ route('predictions.create', $patient->id) }}"class="btn btn-outline-success">Diagnose</a>
                        <form action="{{ route('patients.delete', $patient->id) }}" method="post">
                            @csrf
                            @method('Delete')
                            <button class="btn btn-outline-danger"><i class="fas fa-fw  fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
