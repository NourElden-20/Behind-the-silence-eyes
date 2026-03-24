<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prediction;
use App\Models\Patient;
use Illuminate\Http\Request;

class PredictionApiController extends Controller
{
    public function store(Request $request, $type)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'image'      => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'notes'      => 'nullable|string',
        ]);

        // Save Image
        $path = $request->file('image')->store('retinal_images', 'public');

        // Send to FastAPI
        try {
            $client   = new \GuzzleHttp\Client();
            $response = $client->post(env('FASTAPI_URL') . '/predict/' . $type, [
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => fopen(storage_path('app/public/' . $path), 'r'),
                        'filename' => 'image.jpg'
                    ]
                ]
            ]);

            $result = json_decode($response->getBody(), true);

            $prediction = Prediction::create([
                'patient_id'   => $request->patient_id,
                'doctor_id'    => auth()->id(),
                'disease_type' => $type,
                'confidence'   => $result['confidence'],
                'severity'     => $result['severity'] ?? $result['diagnosis'],
                'image_path'   => $path,
                'notes'        => $request->notes,
                'status'       => 'completed',
            ]);

        } catch (\Exception $e) {
            $prediction = Prediction::create([
                'patient_id'   => $request->patient_id,
                'doctor_id'    => auth()->id(),
                'disease_type' => $type,
                'confidence'   => 0,
                'severity'     => null,
                'image_path'   => $path,
                'notes'        => $request->notes,
                'status'       => 'failed',
            ]);

            return response()->json([
                'message' => 'AI service is unavailable'
            ], 503);
        }

        return response()->json($prediction->load('patient'), 201);
    }

    public function history($patientId)
    {
        $predictions = Prediction::where('patient_id', $patientId)
                        ->where('doctor_id', auth()->id())
                        ->with('patient')
                        ->latest()
                        ->get();

        return response()->json($predictions);
    }
}