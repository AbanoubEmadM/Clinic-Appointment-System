<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "visit_id" => $this->visit_id,
            "medication_name" => $this->medication_name,
            "dosage" => $this->dosage,
            "frequency" => $this->frequency,

        ];
    }
}
