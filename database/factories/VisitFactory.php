<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Prescription;
use App\Models\Visit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Visit>
 */
class VisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'appointment_id' => Appointment::factory(),
            'examination_notes' => fake()->text(),
            'diagnosis' => fake()->text(),
            'treatment_plan' => fake()->text(),
            'follow_up_days' => fake()->randomNumber(),
            'attachment_url' => fake()->url(),
            'finalized_at' => fake()->dateTime(),
        ];
    }
}
