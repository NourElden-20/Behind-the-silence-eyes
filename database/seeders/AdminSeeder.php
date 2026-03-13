<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
             'name'     => 'Admin',
             'email'    => 'admin@silent-eyes.com',
             'password' => Hash::make('admin123456'),
             'role'     => 'admin',
             'phone'    => null,
             'doctor_code' => null,
         ]);

        User::create([
            'name' => 'Doctor Test',
            'email' => 'doctor@silent-eyes.com',
            'password' => Hash::make('doctor123456'),
            'role' => 'doctor',
            'phone' => '01000000000',
            'doctor_code' => 'DOC-0001',
        ]);
    }
}
