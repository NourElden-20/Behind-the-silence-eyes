<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    protected $fillablle=[
        'patient_id',
        'doctor_id',
        'disease_type',
        'confidence',
        'severity',
        'image_path',
        'notes',
        'status'
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function report()
    {
        return $this->hasOne(Report::class);
    }
}
