<?php

namespace Database\Factories;

use App\Models\Prescription;
use App\Models\Visit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Prescription>
 */
class PrescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'medication_name' => fake()->word(),
            'dosage' => fake()->word(),
            'frequency' => fake()->word(),
        ];
    }
}
