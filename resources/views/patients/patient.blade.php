{{-- بتعرض كل المرضى الى عندى  --}}


@foreach ($allPatients as $patient)
    <h1>{{ $patient->name }}</h1>
    <h1>{{ $patient->national_id }}</h1>
    <form action="{{ route('patients.delete', $patient->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button onclick="jjjk" type="submit">delete</button>

    </form>
    <a href="{{ route('patients.show', $patient->id) }}">view</a>
    <a href="{{ route('patients.edit', $patient->id) }}">edit</a>
    <a href="{{ route('predictions.create', $patient->id) }}">diag</a>
    <!DOCTYPE html>




    <hr>
@endforeach
