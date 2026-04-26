<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
     use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
     use HasApiTokens;
    protected $fillable = [
        'doctor_code',
        'name',
        'email',
        'password',
        'role',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

      public function patients()
    {
        return $this->hasMany(Patient::class, 'doctor_id');
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class, 'doctor_id');
    }

    // Helper Functions
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isDoctor()
    {
        return $this->role === 'doctor';
    }
}
