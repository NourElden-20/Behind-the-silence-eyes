<form action="{{ route('patient.store') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Name">
    <input type="number" name="age" placeholder="Age">

    <select name="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>

    <input type="date" name="date_of_birth">
    <input type="text" name="national_id" placeholder="National ID">
    <input type="text" name="phone" placeholder="Phone">
    <textarea name="medical_history" placeholder="Medical History"></textarea>

    <button type="submit">Save</button>
</form>
