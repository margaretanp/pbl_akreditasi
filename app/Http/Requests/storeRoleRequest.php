<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeRoleRequest extends FormRequest
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
            'code' => 'required|string|max:4|unique:roles,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Code is required',
            'code.string' => 'Code must be a string',
            'code.max' => 'Code must not exceed 4 characters',
            'code.unique' => 'Code has already been taken',
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not exceed 255 characters',
            'description.string' => 'Description must be a string',
            'description.max' => 'Description must not exceed 255 characters'
        ];
    }
}
