<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(): JsonResponse
    {
        $payments = Payment::paginate(10);
        return response()->json($payments);
    }

    public function show(Payment $payment): JsonResponse
    {
        $payment->get();
        return response()->json($payment);
    }
}
