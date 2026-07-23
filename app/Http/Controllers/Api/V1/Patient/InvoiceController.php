<?php

namespace App\Http\Controllers\Api\V1\Patient;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::whereHas('appointment', function ($q) {
            $q->where('patient_id', auth()->user()->patient->id);
        })->with(['appointment.doctor.user'])->get();
        return response()->json(['data' => $invoices]);
    }
    public function show(Invoice $invoice)
    {
        $invoice->load([
            'appointment.doctor.user',
            'appointment.visit.prescriptions',
            'payments',
        ])->latest()->get();
        return response()->json(['data' => $invoice]);
    }

}
