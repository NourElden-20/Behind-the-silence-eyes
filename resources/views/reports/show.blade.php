{{-- بيتعرض فيها شكل الريبورت قبل ما يطبع ممكن تسيبها عادى خبقا اجيب ال temblet بتاع ال dompdf جاهزه  --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Medical Report</h4>
        </div>
        <div class="card-body">

            <h5>Patient Info</h5>
            <p>Name: {{ $report->prediction->patient->name }}</p>
            <p>Age: {{ $report->prediction->patient->age }}</p>
            <p>Gender: {{ $report->prediction->patient->gender }}</p>

            <hr>

            <h5>Diagnosis Info</h5>
            <p>Disease: {{ $report->prediction->disease_type }}</p>
            <p>Severity: {{ $report->prediction->severity }}</p>
            <p>Confidence: {{ $report->prediction->confidence }}%</p>
            <p>Date: {{ $report->prediction->created_at->format('d M Y') }}</p>

            <hr>

            <h5>Doctor Info</h5>
            <p>Name: {{ $report->prediction->doctor->name }}</p>

        </div>
    </div>
</div>
</body>
</html>