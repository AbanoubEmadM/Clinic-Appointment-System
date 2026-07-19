<?php

namespace App\Http\Controllers\Api\V1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        private AppointmentService $appointmentService
    )
    {}
    public function index()
    {
        $appointments = auth()->user()
            ->patient
            ->appointments()
            ->with(['doctor.user'])
            ->latest()
            ->get();
        return response()->json(['data' => $appointments], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        $appointment = $this->appointmentService->store($request->validated());
        return response()->json(['data' => $appointment], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $appointment->load(['doctor.user']);
        return response()->json(['data' => $appointment], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->validated());
        return response()->json(['data' => $appointment], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cancel(AppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update([
            'status' => 'cancelled',
            'cancellation_reason' => $request->reason,
        ]);
        return response()->json(['message' => 'Appointment Deleted Successfully'], 200);
    }
}
