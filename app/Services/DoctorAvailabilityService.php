<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Carbon;

class DoctorAvailabilityService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getAvailableSlots(Doctor $doctor, string $date): array
    {
        // Find doctor's schedule for that weekday
        $schedule = $doctor->schedules()
            ->where('day_of_week', Carbon::parse($date)->dayOfWeekIso)
            ->first();
        if (!$schedule) {
            return [];
        }

        // Generate all possible slots
        $slots = $this->generateSlots($schedule->start_time, $schedule->end_time, 30);

        // Retrieve booked slots
        $bookedSlots = Appointment::query()
            ->where('doctor_id', $doctor->id)
            ->whereDate('scheduled_at', $date)
            ->whereIn('status', [
                'pending_confirmation',
                'confirmed',
            ])
            ->pluck('scheduled_at')
            ->map(fn ($dateTime) => Carbon::parse($dateTime)->format('H:i'))
            ->toArray();

        // Remove booked slots
        return array_values(array_diff($slots, $bookedSlots));
    }
    private function generateSlots(string $startTime, string $endTime, int $duration): array
    {
        $slots = [];
        $start = Carbon::createFromTimeString($startTime);
        $end = Carbon::createFromTimeString($endTime);

        while ($start->copy()->addMinute($duration)->lte($end)) {
            $slots[] = $start->format('H:i');
            $start->addMinute($duration);
        }
        return $slots;
    }
}
