<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Prediction;
use Illuminate\Http\Request;

class PredectionController extends Controller
{
    public function create($id)
    {
        $patient = Patient::findOrFail($id);

        return view('predictions.create', compact('patient'));

    }

    public function store(Request $request)
    {
        // 11111111111
        $request->validate([
            'image' => 'image|required',
            'patient_id' => 'required|exists:patients,id',
            'disease_type' => 'required|in:diabetes,anemia,hypertension',
        ]);

        // 222222222222222222222222222222
        $path = $request->file('image')->store('retinal_images', 'public');

        // 33333333333333333333333333
        try {
            $client = new \GuzzleHttp\Client;
            $response = $client->post(env('FASTAPI_URL').'/predict/'.$request->disease_type, [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => fopen(storage_path('app/public/'.$path), 'r'),
                        'filename' => 'image.jpg',
                    ],
                ],
            ]);

            $result = json_decode($response->getBody(), true);
            $prediction=Prediction::create(
                [
            'patient_id'   => $request->patient_id,
            'doctor_id'    => auth()->id(),
            'disease_type' => $request->disease_type,
            'confidence'   => $result['confidence'],
            'severity'     => $result['severity'] ?? $result['diagnosis'],
            'image_path'   => $path,
            'notes'        => $request->notes,
            'status'       => 'completed',
                ]
            );

        }
        catch (\Exception $e) {

        // 5. لو FastAPI وقع
        $prediction = Prediction::create([
            'patient_id'   => $request->patient_id,
            'doctor_id'    => auth()->id(),
            'disease_type' => $request->disease_type,
            'confidence'   => 0,
            'severity'     => null,
            'image_path'   => $path,
            'notes'        => $request->notes,
            'status'       => 'failed',
        ]);

        return redirect()->back()->with('error', 'AI service is unavailable');
    }
    return redirect()->route('predictions.result', $prediction->id)
        ->with('success', 'Diagnosis completed');
    }


    public function result($id)
{
    $prediction = Prediction::with(['patient', 'doctor'])->findOrFail($id);
    return view('predictions.result', compact('prediction'));
}
}
