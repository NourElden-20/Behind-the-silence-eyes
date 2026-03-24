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

        // آخر 5 تشخيصات
        $predictions = Prediction::where('doctor_id', $doctorId)
            ->with('patient')
            ->latest()
            ->take(5)
            ->get();

        // Today's Diagnoses
        $todayDiagnoses = Prediction::where('doctor_id', $doctorId)
            ->whereDate('created_at', today())
            ->count();
        // آخر 7 أيام بدل الشهور
        $dailyData = Prediction::where('doctor_id', $doctorId)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->whereBetween('created_at', [now()->subDays(6), now()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartLabels = [];
        $chartData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $label = now()->subDays($i)->format('d M');
            $found = $dailyData->firstWhere('date', $date);

            $chartLabels[] = $label;
            $chartData[] = $found ? $found->total : 0;
        }

        // Disease Distribution للـ Pie Chart
        $diseaseData = Prediction::where('doctor_id', $doctorId)
            ->selectRaw('disease_type, COUNT(*) as total')
            ->groupBy('disease_type')
            ->get();

        $diabetesCount = $diseaseData->firstWhere('disease_type', 'diabetes')->total ?? 0;
        $anemiaCount = $diseaseData->firstWhere('disease_type', 'anemia')->total ?? 0;
        $hypertensionCount = $diseaseData->firstWhere('disease_type', 'hypertension')->total ?? 0;

        return view('dashboard.doctor', compact(
            'totalPatient',
            'totalPrediction',
            'todayDiagnoses',
            'predictions',
            'chartLabels',
            'chartData',
            'diabetesCount',
            'anemiaCount',
            'hypertensionCount',
        ));
    }
}
