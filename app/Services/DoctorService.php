<?php

namespace App\Services;

use App\Http\Requests\DoctorRequest;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;

class DoctorService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    // DB Transaction must be used here as we will update many tables concurrently so if one process failed we must rollback everything

    public function update(array $data, Doctor $doctor)
    {
        DB::transaction(function () use ($data, $doctor) {
            $doctor->user->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'is_active' => $data['is_active'],
            ]);
            $doctor->update([
                'specialty' => $data['specialty'],
                'license_number' => $data['license_number'],
                'consultation_fee' => $data['consultation_fee'],
                'bio' => $data['bio'],
            ]);
        });
        return response()->json(['doctor' => $doctor]);
    }

}
