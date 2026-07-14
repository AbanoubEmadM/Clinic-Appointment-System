<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentDetailsResource extends JsonResource
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
            'status' => $this->status,
            'scheduled_at' => $this->scheduled_at,
            'duration_time' => $this->duration_time,
            'chief_complaint' => $this->chief_complaint,
            'cancellation_reason' => $this->cancellation_reason,
            'checked_in_at' => $this->checked_in_at,
            'visit' => new VisitDetailsResource($this->visit)
        ];
    }
}
