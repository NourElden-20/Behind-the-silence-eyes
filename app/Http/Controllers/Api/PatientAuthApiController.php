<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Prediction;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientAuthApiController extends Controller
{
    public function login(Request $request)
    {
        // 1. التحقق من البيانات (Validation)
        $request->validate([
            'national_id' => 'required|exists:patients,national_id'
        ], [
            'national_id.exists' => 'رقم الهوية هذا غير مسجل لدينا.'
        ]);

        $patient = Patient::where('national_id', $request->national_id)->first();

        // 2. إدارة التوكن (Sanctum)
        // حذف التوكنات القديمة لضمان تسجيل دخول واحد فقط (اختياري)
        $patient->tokens()->delete();

        // إنشاء التوكن الجديد
        $token = $patient->createToken('patient_api_token')->plainTextToken;

        // 3. الرد
        return response()->json([
            'status' => true,
            'message' => 'sign in successfully',
            'token' => $token,
            'patient' => [
                'id'          => $patient->id,
                'name'        => $patient->name,
                'age'         => $patient->age,
                'gender'      => $patient->gender,
                'national_id' => $patient->national_id,
                'phone'       => $patient->phone,
            ]
        ], 200);
    }

    public function profile()
    {
        // إرجاع بيانات المريض المسجل حالياً
        return response()->json([
            'status' => true,
            'data'   => auth()->user()
        ]);
    }

    public function diagnoses()
    {
        // استخدام العلاقة المعرفة في الموديل (أسرع وأنظف)
        $predictions = auth()->user()->predictions()->latest()->get();

        return response()->json([
            'status' => true,
            'data'   => $predictions
        ]);
    }

    public function reports()
    {
        $patientId = auth()->id();

        // جلب التقارير المرتبطة بتوقعات هذا المريض فقط
        $reports = Report::whereHas('prediction', function ($query) use ($patientId) {
            $query->where('patient_id', $patientId);
        })->with('prediction')->latest()->get();

        return response()->json([
            'status' => true,
            'data'   => $reports
        ]);
    }

    public function logout()
    {
        // حذف التوكن الحالي المستخدم في الطلب
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'status'  => true,
            'message' => 'sign out successfully'
        ]);
    }
}