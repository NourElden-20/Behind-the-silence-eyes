<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
    }
}
