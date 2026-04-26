<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prediction;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ReportApiController extends Controller
{
    public function generate($id)
    {
        $prediction = Prediction::with(['patient', 'doctor'])->findOrFail($id);

        $pdf      = Pdf::loadView('reports.template', compact('prediction'));
        $pdf->setPaper('A4', 'portrait');

        $filename = 'report_' . $id . '_' . time() . '.pdf';
        $path     = 'reports/' . $filename;

        Storage::put('public/' . $path, $pdf->output());

        Report::updateOrCreate(
            ['prediction_id' => $id],
            ['file_path'     => $path]
        );

        return response()->json([
            'message'  => 'Report generated successfully',
            'file_url' => asset('storage/' . $path)
        ]);
    }

    public function show($id)
    {
        $report = Report::with(['prediction.patient', 'prediction.doctor'])
                    ->findOrFail($id);

        return response()->json([
            'report'   => $report,
            'file_url' => asset('storage/' . $report->file_path)
        ]);
    }
}