<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'status' => $this->status,
            'issued_at' => $this->issued_at,
            'due_date' => $this->due_date,
            'notes' => $this->notes,
            'appointment' => new AppointmentResource($this->appointment),
            'patient' => new PatientResource($this->appointment->patient),
            'user' => new UserResource($this->appointment->patient->user),
            'doctor' => new DoctorResource($this->appointment->doctor),
        ];
    }
}
