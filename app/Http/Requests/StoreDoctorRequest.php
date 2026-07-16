<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDoctorRequest extends FormRequest
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
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],
            'password' => ['required', 'min:8'],
            'phone_number' => [
                'required',
                Rule::unique('users', 'phone_number'),
            ],
            'is_active' => ['required', 'boolean'],
            'yoe' => ['required', 'integer'],
            // Doctor
            'specialty' => ['required', 'string', 'max:255'],
            'license_number' => ['required', 'string', 'max:255', Rule::unique('doctors', 'license_number')],
            'consultation_fee' => ['required', 'numeric', 'min:0'],
            'bio' => ['required', 'string', 'max:255'],
        ];
    }
}
