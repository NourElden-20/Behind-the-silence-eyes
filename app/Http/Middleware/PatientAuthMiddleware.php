<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PatientAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('patient_id')) {
            return redirect()->route('patient.login');
        }
        return $next($request);
    }
}