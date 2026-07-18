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
        $invoice = Invoice::with([
            'appointment.patient.user',
            'appointment.doctor',
        ])->findOrFail($invoice->id);
        return response()->json(['data' => new InvoiceDetailsResource($invoice)]);
    }
}
