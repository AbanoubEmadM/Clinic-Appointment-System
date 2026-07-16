<?php

namespace App\Http\Requests;

use App\Http\Resources\AppointmentDetailsResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\VisitDetailsResource;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateDoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Fetches user ID from route parameter /admin/doctors/{doctor}
        $doctorID = $this->route('doctor')?->id;
        return [
            // User
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->route('doctor')->user_id),
            ],
            'phone_number' => [
                'required',
                Rule::unique('users')->ignore($this->route('doctor')->user_id),
            ],
            'is_active' => ['required', 'boolean'],

            // Doctor
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'specialty' => ['required', 'string', 'max:255'],
            'license_number' => ['required', 'string', 'max:255', Rule::unique('doctors', 'license_number')->ignore($doctorID)],
            'consultation_fee' => ['required', 'numeric', 'min:0'],
            'bio' => ['required', 'string', 'max:255'],
        ];
    }
}
