<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorDetailsResource extends JsonResource
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
            'specialty' => $this->specialty,
            'license_number' => $this->license_number,
            'years_of_exp' => $this->yoe,
            'consultation_fee' => $this->consultation_fee,
            'bio' => $this->bio,
            'user' => new UserResource($this->user),
            'appointments' => AppointmentDetailsResource::collection($this->appointments),
            'visit' => new VisitDetailsResource($this->visit)
        ];
    }
}
