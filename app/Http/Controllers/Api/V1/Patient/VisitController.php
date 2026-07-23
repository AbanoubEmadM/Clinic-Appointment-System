<?php

namespace App\Http\Controllers\Api\V1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\VisitDetailsResource;
use App\Models\Appointment;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = auth()->user()
            ->patient
            ->appointments()
            ->with(['visit.prescriptions', 'doctor.user'])
            ->get();

        $visits = $appointments->pluck('visit');
        return response()->json(['data' => VisitDetailsResource::collection($visits)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Visit $visit)
    {
        $visit->load(['visit.prescriptions', 'doctor.user']);
        return response()->json(['data' => new VisitDetailsResource($visit)]);
    }

}
