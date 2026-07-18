<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index()
    {
        $visits = Visit::paginate(10);
        return response()->json(['data' => $visits], 200);
    }
    public function show(Visit $visit)
    {
        $visit->load([
            'appointment.doctor.user:id,first_name,last_name',
            'appointment.patient.user:id,first_name,last_name',
        ]);
        return response()->json(['data' => $visit], 200);
    }
}
