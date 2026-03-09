<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Prediction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            return $this->adminDashboard();
        }

        return $this->doctorDashboard();
    }

    private function adminDashboard()
    {
        $totalDoctors = User::where('role', 'doctor')->count();
        $totalPatient = Patient::count();
        $totalPrediction = Prediction::count();
        $predictions = Prediction::with('patient')->latest()->take(5)->get();

        return View('dashboard.admin', compact(
            'totalDoctors',
            'totalPatient',
            'totalPrediction',
            'predictions',
        ));
    }

    private function doctorDashboard()
    {
        $doctorId = auth()->id();
        $totalPatient = Patient::where('doctor_id', $doctorId)->count();
        $totalPrediction = Prediction::where('doctor_id', $doctorId)->count();
        $predictions = Prediction::where('doctor_id', $doctorId)->latest()->take(5)->get();

        return view('dashboard.doctor', compact(
            'totalPatient',
            'totalPrediction',
            'predictions'
        ));

    }
}
