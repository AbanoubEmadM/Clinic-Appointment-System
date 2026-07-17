<?php

namespace App\Services;

use App\Http\Requests\UpdateReceptionistRequest;
use App\Models\Receptionist;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ReceptionistService
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
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'first_name' => $data['firstname'],
                'last_name' => $data['lastname'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'receptionist',
                'phone_number' => $data['phone'],
                'is_active' => true,
            ]);
            Receptionist::create([
                'user_id' => $user->id,
            ]);
        });
    }
    public function update(array $data, Receptionist $receptionist)
    {
        $receptionist->user->update([
            'first_name' => $data['firstname'],
            'last_name' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'receptionist',
            'phone_number' => $data['phone'],
            'is_active' => true,
        ]);
        $receptionist->fresh(['user']);
        return $receptionist;
    }
}
