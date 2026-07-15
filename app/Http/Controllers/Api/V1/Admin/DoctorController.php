<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Http\Resources\DoctorDetailsResource;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        DB::beginTransaction();

    }
}
