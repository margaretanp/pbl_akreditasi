<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateKriteriaRequest extends FormRequest
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
            'name' => 'string|max:255'
        ];
    }

    public function messages()
    {
        return[
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not exceed 255 characters'
        ];
    }
}