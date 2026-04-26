<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Prediction;
use App\Models\Report;
use Illuminate\Http\Request;

class PatientAuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'national_id' => 'required'
        ]);

        $patient = Patient::where('national_id', $request->national_id)->first();

        if (!$patient) {
            return response()->json(['message' => 'National ID not found'], 404);
        }

        $token = bin2hex(random_bytes(32));
        $patient->update(['patient_token' => $token]);

        return response()->json([
            'token'   => $token,
            'patient' => [
                'id'          => $patient->id,
                'name'        => $patient->name,
                'age'         => $patient->age,
                'gender'      => $patient->gender,
                'national_id' => $patient->national_id,
            ]
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json($request->auth_patient);
    }

    public function diagnoses(Request $request)
    {
        $predictions = Prediction::where('patient_id', $request->auth_patient->id)
                        ->latest()
                        ->get();

        return response()->json($predictions);
    }

    public function reports(Request $request)
    {
        $reports = Report::whereHas('prediction', function ($q) use ($request) {
            $q->where('patient_id', $request->auth_patient->id);
        })->with('prediction')->get();

        return response()->json($reports);
    }

    public function logout(Request $request)
    {
        $request->auth_patient->update(['patient_token' => null]);
        return response()->json(['message' => 'Logged out successfully']);
    }
}