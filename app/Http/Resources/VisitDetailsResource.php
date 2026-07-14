<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitDetailsResource extends JsonResource
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
            'examination_notes' => $this->examination_notes,
            'diagnosis' => $this->diagnosis,
            'treatment_plan' => $this->treatment_plan,
            'follow_up_days' => $this->follow_up_days,
            'attachment_url' => $this->attachment_url,
            'finalized_at' => $this->finalized_at
        ];
    }
}
