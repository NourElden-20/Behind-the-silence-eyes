@extends("layouts.app")
@section("main-content")
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Dashboard Report</h1>
        <hr>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Metric</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                <td>Total Diagnoses</td>
                                <td>{{ $totalPrediction }}</td>
                            </tr>
                            <tr>
                                <td>Today's Diagnoses</td>
                                <td>{{ $todayPrediction }}</td>
                            </tr>
                            <tr>
                                <td>Diabetes Cases</td>
                                <td>{{ $diabetesCount }}</td>
                            </tr>
                             <tr>
                                <td>Hypertension Cases</td>
                                <td>{{ $hypertensionCount }}</td>
                            </tr>
                            <tr>
                                <td>Anemia Cases</td>
                                <td>{{ $anemiaCount }}</td>
                            </tr>
                            
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
@endsection
