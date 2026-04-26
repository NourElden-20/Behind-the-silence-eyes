<?php

namespace App\Http\Middleware;

use App\Models\Patient;
use Closure;
use Illuminate\Http\Request;

class PatientAuthApiMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token   = $request->bearerToken();
        $patient = Patient::where('patient_token', $token)->first();

        if (!$patient) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $request->merge(['auth_patient' => $patient]);
        return $next($request);
    }
}