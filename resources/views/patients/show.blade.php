{{-- بتعض اتفاصيل المريض --}}

@foreach($predictions as $prediction)
    <h1>{{ $prediction->patient->name }}</h1>
    <h1>{{ $prediction->disease_type }}</h1>
    <h1>{{ $prediction->confidence }}</h1>
    <form action="{{ route('reports.generate',$prediction->id) }}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit">Generate Report</button>
</form>
@endforeach


