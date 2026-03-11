<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = User::where('role','doctor')->latest()->paginate(10);
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

     public function store(Request $request)
    {
        $request->validate([
            'doctor_code' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required'
        ]);

        User::create([
            'doctor_code' => $request->doctor_code,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'doctor',
            'phone' => $request->phone
        ]);

        return redirect()->route('doctors.index')->with('success','Doctor created successfully');
    }
     public function show($id)
    {
        $doctor = User::findOrFail($id);

        return view('doctors.show', compact('doctor'));
    }
     public function edit($id)
    {
        $doctor = User::findOrFail($id);

        return view('doctors.edit', compact('doctor'));
    }
    public function update(Request $request, $id)
    {
        $doctor = User::findOrFail($id);

        $doctor->doctor_code = $request->doctor_code;
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->phone = $request->phone;

        if($request->password){
            $doctor->password = bcrypt($request->password);
        }

        $doctor->save();

        return redirect()->route('doctors.index')->with('success','Doctor updated successfully');
    }
     public function destroy($id)
    {
        $doctor = User::findOrFail($id);
        $doctor->delete();

        return redirect()->route('doctors.index')->with('success','Doctor deleted successfully');
    }

}
