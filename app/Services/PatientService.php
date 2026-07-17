<?php

namespace App\Services;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientService
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
        DB::beginTransaction();
        try {
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'is_active' => $data['is_active'],
                'phone_number' => $data['phone_number'],
                'role' => 'patient',
            ]);
            $patient = Patient::create([
                'user_id' => $user->id,
                'full_name' => $data['full_name'],
                'date_of_birth' => $data['date_of_birth'],
                'gender' => $data['gender'],
                'blood_type' => $data['blood_type'],
                'allergies' => $data['allergies'],
                'chronic_conditions' => $data['chronic_conditions'],
                'emergency_contact' => $data['emergency_contact'],
            ]);
            DB::commit();
        } catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
        return $patient;
    }

    public function update(array $data, Patient $patient)
    {
        DB::beginTransaction();
        try {
            $patient->user->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone_number' => $data['phone_number'],
                'email' => $data['email'],
                'is_active' => $data['is_active'],
                'password' => Hash::make($data['password']),
            ]);
            $patient->update([
                'full_name' => $data['full_name'],
                'date_of_birth' => $data['date_of_birth'],
                'gender' => $data['gender'],
                'blood_type' => $data['blood_type'],
                'allergies' => $data['allergies'],
                'chronic_conditions' => $data['chronic_conditions'],
                'emergency_contact' => $data['emergency_contact'],
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $patient->fresh(['user']);
    }
}
