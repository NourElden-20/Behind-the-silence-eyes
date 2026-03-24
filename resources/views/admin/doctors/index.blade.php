{{-- بتعرض كل الدكاتره عند الادمن --}}
@extends('layouts.app')
@section('main-content')
    <div class="row justify-content-between pb-2">
        <div class="col-6">
            <div class="search-container">
                <input type="text" class="form-control search-input" placeholder="Search by national ID...">
            </div>
        </div>

        <div>
            <a href="{{ route('doctors.create') }}" class="btn btn-primary active" role="button">
                + Add New Doctor
            </a>
        </div>
    </div>

    <div class="row justify-content-around">

        @foreach ($doctors as $doctor )
            <div class="card border-dark col-lg-6 mt-2" style="max-width: 18rem;">

                <div class="card-header">
                    {{ $doctor->name }}

                    <div class="d-flex gap-2">
                        <h6>{{ $doctor->age }} years</h6>
                        <h6>{{ $doctor->gender }}</h6>
                    </div>
                </div>

                <div class="card-body text-dark">

                    <div class="d-flex justify-content-between">
                        <h6>National ID:</h6>
                        <h6>{{ $doctor->national_id }}</h6>
                    </div>

                    <div class="d-flex justify-content-between">
                        <h6>Date of Birth:</h6>
                        <h6>{{ $doctor->date_of_birth }}</h6>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('doctors.show', $doctor->id) }}" class="btn btn-outline-primary">
                            View
                        </a>

                        <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-outline-primary">
                            Edit
                        </a>

                        <form action="{{ route('doctors.delete', $doctor->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-outline-danger">
                                <i class="fas fa-fw fa-trash"></i>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @endforeach

    </div>
@endsection