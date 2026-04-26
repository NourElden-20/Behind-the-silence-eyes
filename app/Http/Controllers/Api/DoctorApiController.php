<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorApiController extends Controller
{
    public function index()
    {
        $doctors = User::where('role', 'doctor')
                    ->latest()
                    ->paginate(10);

        return response()->json($doctors);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:6',
            'phone'       => 'required',
            'doctor_code' => 'required|string|unique:users,doctor_code',
        ]);

        $doctor = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'phone'       => $request->phone,
            'doctor_code' => $request->doctor_code,
            'role'        => 'doctor',
        ]);

        return response()->json($doctor, 201);
    }

    public function show($id)
    {
        $doctor = User::where('role', 'doctor')
                    ->findOrFail($id);

        return response()->json($doctor);
    }

    public function update(Request $request, $id)
    {
        $doctor = User::where('role', 'doctor')
                    ->findOrFail($id);

        $doctor->update($request->all());

        return response()->json($doctor);
    }

    public function destroy($id)
    {
        $doctor = User::where('role', 'doctor')
                    ->findOrFail($id);

        $doctor->delete();

        return response()->json(['message' => 'Doctor deleted successfully']);
    }
}