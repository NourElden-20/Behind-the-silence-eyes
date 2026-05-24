<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileApiController extends Controller
{
    public function update(Request $request)
    {
        $doctor = auth()->user();

        // 1. الـ Validation
        $request->validate([
            'doctor_code' => 'sometimes|required|string|max:255',
            'name'        => 'sometimes|required|string|max:255',
            // بنسمح بتكرار الإيميل لنفس الدكتور، لكن بنمنعه لو كان بتاع دكتور تاني
            'email'       => 'sometimes|required|email|max:255|unique:users,email,' . $doctor->id,
            'phone'       => 'sometimes|required|string|max:20',
        ]);

        // 2. تحديث البيانات
        // استخدمت fill و save أو update مباشرة
        $doctor->update($request->only(['doctor_code', 'name', 'email', 'phone']));

        // 3. الرد بـ JSON
        return response()->json([
            'status'  => true,
            'message' => 'Profile updated successfully',
            'doctor'  => [
                'id'          => $doctor->id,
                'doctor_code' => $doctor->doctor_code,
                'name'        => $doctor->name,
                'email'       => $doctor->email,
                'phone'       => $doctor->phone,
            ]
        ], 200);
    }
}