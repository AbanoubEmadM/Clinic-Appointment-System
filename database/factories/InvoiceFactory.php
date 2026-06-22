<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Invoice>
 */
class InvoiceFactory extends Factory
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
            'amount' => fake()->randomFloat(2, 10, 100),
            'status' => fake()->randomElement(['paid', 'unpaid', 'partial']),
            'issued_at' => fake()->dateTime(),
            'due_date' => fake()->dateTime(),
            'notes' => fake()->text(),
        ];
    }
}
