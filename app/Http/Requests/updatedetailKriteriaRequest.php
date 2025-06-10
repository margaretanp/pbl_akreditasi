<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updatedetailKriteriaRequest extends FormRequest
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
            'kriteria_id' => [
                'nullable',
                'integer',
                'exists:kriteria,id'
            ],
            'jenis_kriteria_id' => [
                'nullable',
                'integer',
                'exists:jenis_kriteria,id'
            ],
            'description' => 'nullable|string',
            'file_url' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg'
        ];
    }

    public function messages()
    {
        return [
            'kriteria_id.exists' => 'Kriteria ID must exist in the kriteria table',
            'jenis_kriteria_id.exists' => 'Jenis Kriteria ID must exist in the jenis_kriteria table',
        ];
    }
}
