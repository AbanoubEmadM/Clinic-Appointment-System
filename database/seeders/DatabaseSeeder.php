<?php

namespace Database\Seeders;

use App\Models\DoctorSchdule;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Admin',
             'last_name' => 'Admin',
             'password' => \Hash::make('password'),
             'role' => 'admin',
             'is_active' => true,
             'phone_number' => '01274526679',
             'email' => 'admin@admin.com',
         ]);
        User::factory(10)->create();

         $this->call([
             DoctorSeeder::class,
             PatientSeeder::class,
             AppointmentSeeder::class,
             DoctorReviewSeeder::class,
             InvoiceSeeder::class,
             PaymentSeeder::class,
             PrescriptionSeeder::class,
             VisitSeeder::class,
             ReceptionistSeeder::class,
             DoctorScheduleSeeder::class,

         ]);
    }
}
