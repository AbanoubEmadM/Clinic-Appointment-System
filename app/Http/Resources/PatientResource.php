<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
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
            'full_name' => $this->full_name,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'blood_type' => $this->blood_type,
            'allergies' => $this->allergies,
            'chronic_conditions' => $this->chronic_conditions,
            'emergency_contact' => $this->emergency_contact,
            'user' => new UserResource($this->user)

        ];
    }
}
