{{-- الفورم الى بعمل منها تعديل مريض  --}}



<form action="{{ route('patients.update',$patient->id) }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Name" value="{{ $patient->name }}">
    <input type="number" name="age" placeholder="Age" value="{{ $patient->age }}">

    <select name="gender" value="{{ $patient->gender }}">
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>

    <input type="date" name="date_of_birth" value="{{ $patient->date_of_birth }}">
    <input type="text" name="national_id" placeholder="National ID" value="{{ $patient->national_id }}">
    <input type="text" name="phone" placeholder="Phone" value="{{ $patient->phone }}">
    <textarea name="medical_history" placeholder="Medical History"  >{{ $patient->medical_history }}</textarea>

    <button type="submit">Save</button>
</form>
