<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePatientRequest extends FormRequest
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
        return [
            // User
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->route('patient')->user_id),
            ],
            'phone_number' => [
                'required',
                Rule::unique('users')->ignore($this->route('patient')->user_id),
            ],
            'is_active' => ['required', 'boolean'],
            'password' => ['required', 'string', 'min:8'],

            // Patient
            'full_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date', 'date_format:Y-m-d'],
            'gender' => ['required', 'string', 'max:6'],
            'blood_type' => ['required', 'string', 'max:3'],
            'allergies' => ['required', 'string', 'max:255'],
            'chronic_conditions' => ['required', 'string', 'max:255'],
            'emergency_contact' => ['required', 'string', 'max:255'],
        ];
    }
}
