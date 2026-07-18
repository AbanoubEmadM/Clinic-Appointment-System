<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceDetailsResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::paginate(10);
        return response()->json(['data' => $invoices]);
    }
    public function show(Invoice $invoice)
    {
        $invoice->load([
            'appointment:id,patient_id,doctor_id',
            'appointment.patient:id,user_id',
            'appointment.patient.user:id,first_name,last_name',
            'appointment.doctor:id,user_id,specialty',
            'appointment.doctor.user:id,first_name,last_name',
            'appointment.visit:id,appointment_id',
            'appointment.visit.prescriptions:id,visit_id,medication_name,dosage',
            ]);
        return response()->json(['data' => $invoice]);
    }
}
