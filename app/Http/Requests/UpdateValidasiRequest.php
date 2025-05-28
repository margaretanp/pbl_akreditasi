<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateValidasiRequest extends FormRequest
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
            'id_user'          => 'sometimes|integer|exists:users,id',
            'id_detail_kriteria' => 'sometimes|integer|exists:detail_kriteria,id',
            'validated_at'   => 'sometimes|date',
            'komentar'         => 'nullable|string|max:1000',
            'status'           => 'sometimes|in:pending,valid,invalid',
        ];
    }

    /**
     * Custom error messages for validation.
     */
    public function messages()
    {
        return [
            'id_user.integer'         => 'User ID must be an integer',
            'id_user.exists'          => 'User ID must exist in users table',

            'id_detail_kriteria.integer' => 'Detail Kriteria ID must be an integer',
            'id_detail_kriteria.exists' => 'Detail Kriteria ID must exist in detail_kriteria table',

            'validated_date.date'     => 'Validation date must be a valid date',

            'komentar.string'         => 'Komentar must be a string',
            'komentar.max'            => 'Komentar must not exceed 1000 characters',

            'status.in'               => 'Status must be one of: approved, rejected, or pending',
        ];
    }
}
