<?php
namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentDetailsResource;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['doctor', 'patient', 'doctor.user'])
            ->paginate(10);
        return response()->json([
            'data' => AppointmentResource::collection($appointments),
        ]);
    }
    public function show(Appointment $appointment)
    {
        $appointment->load(['patient.user', 'doctor.user', 'visit.prescriptions', 'invoice.payment']);
        return response()->json(['appointment' => new AppointmentDetailsResource($appointment)]);
    }
}
