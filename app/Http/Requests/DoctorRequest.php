<?php

namespace App\Http\Requests;

use App\Models\Doctor;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->can('update', Doctor::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Fetches user ID from route parameter /users/{user}
        $userID = $this->route('user')?->id;
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('doctors', 'email')->ignore($userID)
            ],
            'phone_number' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],

            'appointments.*.status' => ['required', 'string', 'max:20'],
            'appointments.*.duration_time' => ['required', 'integer'],
            'appointments.*.chief_complaint' => ['required', 'string', 'max:255'],
            'appointments.*.cancellation_reason' => ['required', 'string', 'max:255'],
            'appointments.*.checked_in_at' => ['required', 'date', 'date_format:Y-m-d'],

            'visit.examination_notes' => ['required', 'string', 'max:255'],
            'visit.diagnosis' => ['required', 'string', 'max:255'],
            'visit.treatment_plan' => ['required', 'string', 'max:255'],
            'visit.follow_up_days' => ['required', 'integer'],
            'visit.attachment_url' => ['required', 'url', 'max:255'],
            'visit.finalized_at' => ['required', 'date', 'date_format:Y-m-d'],

        ];
    }
}
