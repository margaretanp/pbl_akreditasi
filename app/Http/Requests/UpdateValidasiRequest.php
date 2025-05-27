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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_validator' => 'sometimes|required|exists:users,id',
            'id_user' => 'sometimes|required|exists:users,id',
            'validated_at' => 'nullable|date',
            'notes' => 'nullable|string|max:1000',
            'status' => 'sometimes|required|in:valid,invalid,pending',
        ];
    }
}
