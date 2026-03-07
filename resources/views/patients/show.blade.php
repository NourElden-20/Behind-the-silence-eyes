@foreach($predictions as $prediction)
    <h1>{{ $prediction->patient->name }}</h1>
    <h1>{{ $prediction->disease_type }}</h1>
    <h1>{{ $prediction->confidence }}</h1>
@endforeach