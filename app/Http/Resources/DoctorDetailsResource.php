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
            'speciality' => $this->speciality,
            'licence_number' => $this->licence_number,
            'yoe' => $this->yoe,
            'consultation_fee' => $this->consultation_fee,
            'bio' => $this->bio,
            'user' => new UserDetailsResource($this->user),
            'appointments' => AppointmentDetailsResource::collection($this->whenLoaded('appointments'))
        ];
    }
}
