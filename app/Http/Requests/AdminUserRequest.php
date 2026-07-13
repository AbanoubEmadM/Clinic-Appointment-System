<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required',
                Rule::email()->strict(),
                Rule::unique('users')->ignore($this->route('user'))
            ],
            'role' => ['required', 'string'],
            'phone_number' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',

            'email.required' => 'Email is required.',
            'email.email' => 'Email is invalid.',
            'email.unique' => 'Email already exists.',

            'role.required' => 'Role is required',
            'phone_number.required' => 'Phone number is required',
            'is_active.required' => 'Active status is required',

        ];
    }
}
