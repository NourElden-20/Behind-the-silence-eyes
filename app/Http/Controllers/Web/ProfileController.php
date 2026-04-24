<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $doctor = auth()->user();

        // Validate the input
        $request->validate([
            'doctor_code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:doctors,email,' . $doctor->id,
            'phone' => 'required|string|max:20',
        ]);

        // Update the doctor's profile
        $doctor->update([
            'doctor_code' => $request->doctor_code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('auth.profile')->with('success', 'Profile updated successfully.');
    }


}
