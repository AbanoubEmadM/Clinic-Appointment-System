<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AppointmentService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private DoctorAvailabilityService $doctorAvailabilityService,
    )
    {
        //
    }
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $doctor = Doctor::findOrFail($data['doctor_id']);
            $scheduledAt = Carbon::parse($data['scheduled_at']);
            $availableSlots = $this->doctorAvailabilityService->getAvailableSlots($doctor, $scheduledAt->toDateString());

            if (! in_array($scheduledAt->format('H:i'), $availableSlots)) {
                throw ValidationException::withMessages([
                    'time' => 'This slot is not available.',
                ]);
            }
            Appointment::create([
                'doctor_id' => $doctor->id,
                'patient_id' => auth()->user()->patient->id,
                'scheduled_at' => $scheduledAt,
                'chief_complaint' => $data['chief_complaint'],
                'cancellation_reason' => $data['cancellation_reason'] ?? null,
                'checked_in_at' => $data['checked_in_at'] ?? null,
            ]);
        });
    }

    public function update(array $data, Appointment $appointment)
    {
    }

}
