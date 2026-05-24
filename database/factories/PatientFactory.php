<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'doctor_id' => \App\Models\User::inRandomOrder()->first()->id,
            'name' => fake()->name(),
            'age' => fake()->numberBetween(18,80),
            'gender' => fake()->randomElement(['male','female']),
            'date_of_birth' => fake()->date(),
            'national_id' => fake()->unique()->numerify('##############'),
            'phone' => '01' . fake()->numberBetween(100000000,999999999),
            'medical_history' => fake()->sentence(),
        ];
    }
}