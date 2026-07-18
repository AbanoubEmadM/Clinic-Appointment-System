<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReceptionistRequest;
use App\Http\Requests\UpdateReceptionistRequest;
use App\Models\Doctor;
use App\Models\Receptionist;
use App\Services\ReceptionistService;

class ReceptionistController extends Controller
{
    public function __construct(
        private ReceptionistService $receptionistService,
    ){}

    public function index()
    {
        $receptionists = Receptionist::with(['user'])->paginate();
        return response()->json(['data' => $receptionists]);
    }
    public function show(Receptionist $receptionist)
    {
        $receptionist = Receptionist::with(['user'])->findOrFail($receptionist->id);
        return response()->json(['data' => $receptionist]);
    }
    public function store(StoreReceptionistRequest $request)
    {
        $receptionist = $this->receptionistService->store($request->validated());
        return response()->json(['data' => $receptionist]);
    }
    public function update(UpdateReceptionistRequest $request, Receptionist $receptionist)
    {
        $receptionist = $this->receptionistService->update($request->validated(), $receptionist);
        return response()->json(['data' => $receptionist]);
    }
    public function destroy(Receptionist $receptionist)
    {
        $receptionist->delete();
        return response()->json(['message' => 'Successfully deleted receptionist']);
    }
    public function updateStatus(Receptionist $receptionist)
    {
        $receptionist->user->update(['is_active' => !$receptionist->user->is_active]);
        return response()->json(['message' => 'Receptionist Status Changed successfully']);
    }

}
