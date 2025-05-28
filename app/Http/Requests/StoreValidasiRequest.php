<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreValidasiRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_validator'     => 'required|integer|exists:users,id',
            'id_user'          => 'required|integer|exists:users,id',
            'validated_date'   => 'required|date',
            'komentar'         => 'nullable|string|max:1000',
            'status'           => 'required|in:approved,rejected,pending',
        ];
    }

    /**
     * Custom error messages for validation.
     */
    public function messages()
    {
        return [
            'id_validator.required'   => 'Validator ID is required',
            'id_validator.integer'    => 'Validator ID must be an integer',
            'id_validator.exists'     => 'Validator ID must exist in users table',

            'id_user.required'        => 'User ID is required',
            'id_user.integer'         => 'User ID must be an integer',
            'id_user.exists'          => 'User ID must exist in users table',

            'validated_date.required' => 'Validation date is required',
            'validated_date.date'     => 'Validation date must be a valid date',

            'komentar.string'         => 'Komentar must be a string',
            'komentar.max'            => 'Komentar must not exceed 1000 characters',

            'status.required'         => 'Status is required',
            'status.in'               => 'Status must be one of: approved, rejected, or pending',
        ];
    }
}
