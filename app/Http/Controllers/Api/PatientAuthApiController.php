<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Prediction;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        // --- التعديل الجوهري: استخدام Sanctum بدلاً من التوكن اليدوي ---
        // بنمسح أي توكنات قديمة للمريض ده عشان ميبقاش فاتح من كذا مكان (اختياري)
        $patient->tokens()->delete();

        // إنشاء توكن رسمي من لارافيل
        $token = $patient->createToken('patient_api_token')->plainTextToken;

        return response()->json([
            'token'   => $token,
            'patient' => [
                'id'          => $patient->id,
                'name'        => $patient->name,
                'age'         => $patient->age,
                'gender'      => $patient->gender,
                'national_id' => $patient->national_id,
                'phone'       => $patient->phone,
            ]
        ]);
    }

    public function profile(Request $request)
    {
        // باستخدام Sanctum، المريض الحالي بيكون موجود في auth()->user()
        return response()->json(auth()->user());
    }

    public function diagnoses(Request $request)
    {
        // بنجيب المريض من التوكن الحالي
        $patient = auth()->user();

        $predictions = Prediction::where('patient_id', $patient->id)
                        ->latest()
                        ->get();

        return response()->json($predictions);
    }

    public function reports(Request $request)
    {
        $patient = auth()->user();

        $reports = Report::whereHas('prediction', function ($q) use ($patient) {
            $q->where('patient_id', $patient->id);
        })->with('prediction')->latest()->get();

        return response()->json($reports);
    }

    public function logout(Request $request)
    {
        // حذف التوكن الحالي اللي المريض داخل بيه
        auth()->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}