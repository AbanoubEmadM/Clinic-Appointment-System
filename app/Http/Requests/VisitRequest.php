<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class VisitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'visit.examination_notes' => ['required', 'string', 'max:255'],
            'visit.diagnosis' => ['required', 'string', 'max:255'],
            'visit.treatment_plan' => ['required', 'string', 'max:255'],
            'visit.follow_up_days' => ['required', 'integer'],
            'visit.attachment_url' => ['required', 'url', 'max:255'],
            'visit.finalized_at' => ['required', 'date', 'date_format:Y-m-d'],
        ];
    }
}
