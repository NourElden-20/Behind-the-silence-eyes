{{-- بتعرض شكل ال pdf قبل الطباعه ممكن تسيبها عادى --}}


<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; }
        h1 { color: #333; }
        hr { margin: 20px 0; }
    </style>
</head>
<body>

    <h1>Medical Report</h1>
    <hr>

    <h3>Patient Info</h3>
    <p>Name: {{ $prediction->patient->name }}</p>
    <p>Age: {{ $prediction->patient->age }}</p>
    <p>Gender: {{ $prediction->patient->gender }}</p>

    <hr>

    <h3>Diagnosis Info</h3>
    <p>Disease: {{ $prediction->disease_type }}</p>
    <p>Severity: {{ $prediction->severity ?? 'N/A' }}</p>
    <p>Confidence: {{ $prediction->confidence }}%</p>
    <p>Date: {{ $prediction->created_at }}</p>

    <hr>

    <h3>Doctor</h3>
    <p>Name: {{ $prediction->doctor->name }}</p>

</body>
</html>