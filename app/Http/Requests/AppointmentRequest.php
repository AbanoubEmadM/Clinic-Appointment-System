<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'appointments.*.status' => ['required', 'string', 'max:20'],
            'appointments.*.duration_time' => ['required', 'integer'],
            'appointments.*.chief_complaint' => ['required', 'string', 'max:255'],
            'appointments.*.cancellation_reason' => ['required', 'string', 'max:255'],
            'appointments.*.checked_in_at' => ['required', 'date', 'date_format:Y-m-d'],
        ];
    }
}
