<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientAuthController extends Controller
{
    public function showLogin()
    {
        return view('patients.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'national_id' => 'required',
        ]);

        $patient = Patient::where('national_id', $request->national_id)->first();

        if (! $patient) {
            return back()->with('error', 'National ID not found');
        }

        session(['patient_id' => $patient->id]);

        return redirect()->route('patient.dashboard');
    }

    public function dashboard()
    {
        $patient = Patient::with(['predictions.report'])
            ->findOrFail(session('patient_id'));

        $predictions = $patient->predictions()->latest()->get();

        return view('patients.dashboard', compact('patient', 'predictions'));
    }

    public function logout()
    {
        session()->forget('patient_id');

        return redirect()->route('patient.login');
    }
}
