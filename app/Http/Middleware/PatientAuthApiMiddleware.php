<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Patient;

class PatientAuthApiMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 1. التأكد إن Sanctum قدر يتعرف على المستخدم من التوكن
        // 2. التأكد إن المستخدم ده هو "مريض" (Patient) مش دكتور
        if (auth()->check() && auth()->user() instanceof Patient) {
            return $next($request);
        }

        // لو التوكن غلط أو التوكن بتاع دكتور بيحاول يدخل هنا
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized: This area is for patients only.'
        ], 401);
    }
}