<?php

namespace App\Services;
use App\Models\Appointment;
use App\Models\DoctorReview;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReviewService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function store(array $data)
    {
        $hasVisited = Appointment::where('patient_id', auth()->user()->patient->id)
            ->where('doctor_id', $data['doctor_id'])
            ->where('status', 'completed')
            ->exists();
        if (!$hasVisited) {
            throw ValidationException::withMessages([
                'doctor_id' => 'You can only review doctors you have visited.',
            ]);
        }
        $review = DoctorReview::create([
            'doctor_id' => $data['doctor_id'],
            'appointment_id' => $data['appointment_id'],
            'patient_id' => auth()->user()->patient->id,
            'rating' => $data['rating'],
            'comment' => $data['comment'],
        ]);
        return $review;
    }
    public function update(array $data)
    {
        $review = DoctorReview::update([
            'rating' => $data['rating'],
            'comment' => $data['comment'],
        ]);
        return $review;

    }

}
