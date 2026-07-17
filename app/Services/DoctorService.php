<?php

namespace App\Services;

use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function store(array $data): Doctor
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'doctor',
                'is_active' => false,
                'phone_number' => $data['phone_number'],
            ]);
           $doctor = Doctor::create([
               'user_id' => $user->id,
              'specialty' => $data['specialty'],
               'yoe' => $data['yoe'],
               'license_number' => $data['license_number'],
               'consultation_fee' => $data['consultation_fee'],
               'bio' => $data['bio'],
           ]);
           return $doctor->load(['user']);
        });
    }
    public function update(array $data, Doctor $doctor)
    {
        return DB::transaction(function () use ($data, $doctor) {
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
    }

}
