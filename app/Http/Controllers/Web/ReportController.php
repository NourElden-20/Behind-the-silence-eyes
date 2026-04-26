<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Prediction;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function generate($id)
    {
        // $pdf=Pdf::loadView('pdf');
        // return $pdf->download();

        $prediction = Prediction::with(['patient', 'doctor'])->findOrFail($id);
        $pdf = Pdf::loadView('reports.template', compact('prediction'));
         $pdf->setPaper('A4', 'portrait');
        $filename = 'report_'.$id.'_'.time().'.pdf';
        $path = 'reports/'.$filename;
        Storage::put('public/'.$path, $pdf->output());

        Report::updateOrCreate(
            ['prediction_id' => $id],
            ['file_path' => $path]
        );

        return $pdf->download($filename);
    }
// public function generate($id)
// {
//     $prediction = Prediction::with(['patient', 'doctor'])->findOrFail($id);
//     return view('reports.template', compact('prediction'));
// }
    public function show($id)
    {
        $report = Report::with(['prediction.patient', 'prediction.doctor'])->findOrFail($id);

        return view('reports.show', compact('report'));

    }

    public function generateReportDashboard()
    {
        $totalPrediction = Prediction::count();
        $todayPrediction = Prediction::whereDate('created_at', now()->toDateString())->count();
        $diabetesCount = Prediction::where('disease_type', 'diabetes')->count();
        $hypertensionCount = Prediction::where('disease_type', 'hypertension')->count();
        $anemiaCount = Prediction::where('disease_type', 'anemia')->count();

        return view('reports.dashboard_report', compact('totalPrediction', 'todayPrediction', 'diabetesCount', 'hypertensionCount','anemiaCount'));

    }

}
