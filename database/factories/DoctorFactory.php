<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'specialty' => fake()->randomElement([
                'general_practice',
                'internal_medicine',
                'pediatrics',
                'cardiology',
                'dermatology',
                'orthopedics',
                'gynecology',
                'ent',
                'dentistry',

            ]),
            'license_number' => fake()->unique()->uuid(),
            'yoe' => fake()->numberBetween(1, 20),
            'consultation_fee' => fake()->randomFloat(2, 10, 100),
            'bio' => fake()->text(),
        ];
    }
}
