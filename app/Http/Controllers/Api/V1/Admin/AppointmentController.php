<?php
namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['doctor:id,speciality', 'patient:id,full_name', 'doctor.user'])
            ->paginate(10);
        return response()->json([
            'appointment' => $appointments,
        ]);
    }
    public function show(Appointment $appointment)
    {
        $appointment = Appointment::with(['patient.user', 'doctor.user', 'visit.prescriptions', 'invoice.payment'])
            ->findOrFail($appointment->id);
        return response()->json(['appointment' => $appointment]);
    }
}
