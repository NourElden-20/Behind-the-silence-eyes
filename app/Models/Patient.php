<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Patient extends Authenticatable 
{
    use HasApiTokens; 
     use  Notifiable;

    protected $fillable = [
        'doctor_id', 'name', 'age', 'gender', 
        'date_of_birth', 'national_id', 'phone', 'medical_history',
    ];

    public function doctor() {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function predictions() {
        return $this->hasMany(Prediction::class);
    }
}