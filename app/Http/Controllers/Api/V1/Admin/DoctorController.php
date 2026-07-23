<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Resources\DoctorDetailsResource;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use App\Services\DoctorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DoctorController extends Controller
{
    public function __construct(
        private DoctorService $doctorService
) {}
    public function index()
    {
        $doctors = Doctor::with(['user:first_name,last_name,email'])->paginate(15);
        return response()->json(['data' => DoctorDetailsResource::collection($doctors)]);
    }
    public function show(Doctor $doctor)
    {
        $doctor->load(['user', 'appointments.visit']);
        return response()->json(['data' => new DoctorDetailsResource($doctor)]);
    }
    public function store(StoreDoctorRequest $request)
    {
        $doctor = $this->doctorService->store($request->validated());
        return response()->json([
            'message' => 'Doctor created successfully',
            'data' => new DoctorResource($doctor)
        ], 201);
    }
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $doctor = $this->doctorService->update($request->validated(), $doctor);
        return response()->json(['data' => $doctor]);

    }
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return response()->json(['message' => 'Doctor deleted successfully']);
    }
    public function updateStatus(Doctor $doctor)
    {
        $doctor->user->update(['is_active' => !$doctor->user->is_active]);
        return response()->json(['message' => 'Doctor Status Changed successfully']);
    }
}
