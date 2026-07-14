<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorDetailsResource;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with(['user:first_name,last_name,email,is_active'])->paginate(15);
        return response()->json(['doctors' => new DoctorDetailsResource($doctors)]);
    }
    public function show(Doctor $doctor)
    {
        $doctor = Doctor::with(['user', 'appointments.visit'])->findOrFail($doctor->id);
        return response()->json(['doctor' => new DoctorDetailsResource($doctor)]);
    }
    public function update(Request $request, Doctor $doctor)
    {

    }
}
