<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storedetailKriteriaRequest extends FormRequest
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
    // storedetailKriteriaRequest.php
    public function rules(): array
    {
        return [
            'criteria_id' => 'required|integer|exists:criteria,id',
            'jenis_criteria_id' => 'required|integer|exists:jenis_criteria,id',
            'description' => 'nullable|string',
            'file_url' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg',
        ];
    }


    public function messages()
    {
        return [
            'criteria_id.required' => 'criteria ID is required',
            'criteria_id.integer' => 'criteria ID must be an integer',
            'criteria_id.exists' => 'criteria ID must exist in the criteria table',
            'jenis_criteria_id.required' => 'Jenis criteria ID is required',
            'jenis_criteria_id.integer' => 'Jenis criteria ID must be an integer',
            'jenis_criteria_id.exists' => 'Jenis criteria ID must exist in the jenis_criteria table',
            'description.string' => 'Description must be a string',
            'file_url.file' => 'File must be a valid file',
            'file_url.mimes' => 'File must be a PDF, DOC, DOCX, PNG, JPG, or JPEG',
        ];
    }
}
