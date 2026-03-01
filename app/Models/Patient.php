<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'doctor_id',
        'name',
        'age',
        'gender',
        'date_of_birth',
        'national_id',
        'phone',
        'medical_history',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }
}
