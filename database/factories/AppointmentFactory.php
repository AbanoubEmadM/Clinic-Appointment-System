<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'doctor_id' => Doctor::factory(),
            'patient_id' => Patient::factory(),
            'status' => fake()->randomElement(['pending_confirmation', 'scheduled', 'completed', 'cancelled', 'no_show']),
            'scheduled_at' => $this->faker->dateTime(),
            'duration_time' => $this->faker->numberBetween(10, 120),
            'chief_complaint' => $this->faker->text(),
            'cancellation_reason' => $this->faker->text(),
            'checked_in_at' => $this->faker->dateTime(),
        ];
    }
}
