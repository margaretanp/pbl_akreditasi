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
                'imteger',
                'exists:kriteria,id'
            ],
            'jenis_kriteria_id' => [
                'nullable',
                'integer',
                'exists:jenis_kriteria,id'
            ],
            'status_validasi' => 'nullable|in:pending,accepted,rejected',
            'status_pengerjaan' => 'nullable|in:save,submitted,revised',
            'file_url' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'kriteria_id.exists' => 'Kriteria ID must exist in the kriteria table',
            'jenis_kriteria_id.exists' => 'Jenis Kriteria ID must exist in the jenis_kriteria table',
            'status_validasi.in' => 'Status Validasi must be one of: pending, accepted, rejected',
            'status_pengerjaan.in' => 'Status Pengerjaan must be one of: save, submitted, revised',
        ];
    }
}
