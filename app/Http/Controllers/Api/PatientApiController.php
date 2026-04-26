<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientApiController extends Controller
{
    public function index()
    {
        $patients = Patient::where('doctor_id', auth()->id())
                    ->latest()
                    ->paginate(10);

        return response()->json($patients);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'age'             => 'required|integer|min:1|max:120',
            'gender'          => 'required|in:male,female',
            'date_of_birth'   => 'required|date',
            'national_id'     => 'required|max:14',
            'phone'           => 'nullable|max:15',
            'medical_history' => 'nullable',
        ]);

        $patient = Patient::create([
            'doctor_id'       => auth()->id(),
            'name'            => $request->name,
            'age'             => $request->age,
            'gender'          => $request->gender,
            'date_of_birth'   => $request->date_of_birth,
            'phone'           => $request->phone,
            'national_id'     => $request->national_id,
            'medical_history' => $request->medical_history,
        ]);

        return response()->json($patient, 201);
    }

    public function show($id)
    {
        $patient     = Patient::where('doctor_id', auth()->id())
                        ->with('predictions')
                        ->findOrFail($id);

        return response()->json($patient);
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::where('doctor_id', auth()->id())
                    ->findOrFail($id);

        $patient->update($request->all());

        return response()->json($patient);
    }

    public function destroy($id)
    {
        $patient = Patient::where('doctor_id', auth()->id())
                    ->findOrFail($id);

        $patient->delete();

        return response()->json(['message' => 'Patient deleted successfully']);
    }
}