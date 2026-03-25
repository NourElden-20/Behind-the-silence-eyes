@extends('layouts.app')

@section('main-content')

    <div class="container-fluid">

        <div class="row justify-content-center">

            <!-- Profile Card -->
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-body text-center">

                        <h3 class="font-weight-bold">{{ auth()->user()->name }}</h3>
                        <p class="text-muted">{{ auth()->user()->email }}</p>

                        <hr>

                        <div class="row text-center">

                            <div class="col">
                                <h5>{{ auth()->user()->patients->count() }}</h5>
                                <small>Patients</small>
                            </div>

                            <div class="col">
                                <h5>{{ auth()->user()->predictions->count() }}</h5>
                                <small>Predictions</small>
                            </div>

                        </div>

                        <hr>

                        <div class="mt-3">
                    <!-- حطيت زرار الايديت ممكن نحتاجو عشان حسيتو كويس يس طبعا هنتطر نعملو صفحة -->
                            <a href="#" class="btn btn-primary btn-sm">
                                Edit Profile
                            </a>

                            <a href="{{ route('patients.create') }}" class="btn btn-success btn-sm m-1">
                                + Add Patient
                            </a>

                            <a href="{{ route('patients.index') }}" class="btn btn-secondary btn-sm m-1">
                                View Patients
                            </a>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Predictions Table -->
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Recent Predictions</h5>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th>Disease</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(auth()->user()->predictions->count() > 0)

                                    @foreach(auth()->user()->predictions()->latest()->take(5)->get() as $prediction)
                                        <tr>
                                            <td>{{ $prediction->patient->name }}</td>
                                            <td>{{ $prediction->disease }}</td>
                                            <td>{{ $prediction->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach

                                @else
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">
                                            No predictions yet
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection