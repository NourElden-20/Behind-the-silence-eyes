{{-- الفورم الى برفع منها الصوره الى هيتم عليها التشخيص --}}



<form action="{{ route('predictions.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="patient_id" value="{{ $patient->id }}">

    <select name="disease_type">
        <option value="diabetes">Diabetes</option>
        <option value="anemia">Anemia</option>
        <option value="hypertension">Hypertension</option>
    </select>

    <input type="file" name="image" accept="image/*">

    <textarea name="notes" placeholder="Notes (optional)"></textarea>

    <button type="submit">Diagnose</button>

</form>