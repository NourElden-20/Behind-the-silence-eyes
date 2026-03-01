<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'prediction_id',
        'file_path',
    ];

    public function prediction()
    {
        return $this->belongsTo(Prediction::class);
    }
}
