<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct(
        private PatientService $patientService,
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::with(['user'])
            ->paginate();
        return response()->json(['data' => PatientResource::collection($patients)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $patient = $this->patientService->store($request->validated());
        return response()->json(['data' => new PatientResource($patient)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        $patient = Patient::with(['user'])
            ->findOrFail($patient->id);
        return response()->json(['data' => new PatientResource($patient)]);

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient = $this->patientService->update($request->validated(), $patient);
        return response()->json(['data' => new PatientResource($patient)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient = Patient::findOrFail($patient->id);
        $patient->delete();
        return response()->json(['message' => 'Patient deleted successfully']);
    }
    public function updateStatus(Patient $patient)
    {
        $patient->user->update(['is_active' => !$patient->user->is_active]);
        return response()->json(['message' => 'Patient Status Changed successfully']);
    }
}
