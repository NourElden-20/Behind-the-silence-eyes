<!-- resources/views/doctors/create.blade.php -->
<h1>Add New Doctor</h1>

<a href="{{ route('doctors.index') }}">Back to Doctors</a>

@if ($errors->any())
    <ul style="color:red">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('doctors.store') }}" method="POST">
    @csrf
    <input type="text" name="doctor_code" placeholder="Doctor Code" value="{{ old('doctor_code') }}"><br>
    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}"><br>
    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"><br>
    <input type="text" name="phone" placeholder="Phone" value="{{ old('phone') }}"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button type="submit">Save</button>
</form>