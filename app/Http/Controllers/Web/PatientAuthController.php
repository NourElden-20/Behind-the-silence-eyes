<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientAuthController extends Controller
{
    public function showLogin() {
        return view('patients.loginPatints');
    }

    public function login(Request $request) {
        $request->validate(['national_id' => 'required']);

        $patient = Patient::where('national_id', $request->national_id)->first();

        if (!$patient) {
            return back()->with('error', 'National ID not found');
        }

        // استخدام الجارد الرسمي للمريض
        Auth::guard('patient')->login($patient);

        return redirect()->route('patient.dashboard');
    }

    public function dashboard() {
        $patient = Auth::guard('patient')->user();

        if (!$patient) {
            return redirect()->route('patient.login');
        }

        $predictions = $patient->predictions()->latest()->get();
        return view("dashboard.patientDashboard", compact('patient', 'predictions'));
    }

    public function logout() {
        Auth::guard('patient')->logout();
        return redirect()->route('patient.login');
    }
}