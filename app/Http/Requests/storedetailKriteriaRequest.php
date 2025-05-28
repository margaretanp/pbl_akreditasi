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
            'kriteria_id' => 'required|integer|exists:kriteria,id',
            'jenis_kriteria_id' => 'required|integer|exists:jenis_kriteria,id',
            'status_validasi' => 'required|in:pending,accepted,rejected',
            'status_pengerjaan' => 'required|in:save,submitted,revised',
            'file_url' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
        ];
    }


    public function messages()
    {
        return [
            'kriteria_id.required' => 'Kriteria ID is required',
            'kriteria_id.integer' => 'Kriteria ID must be an integer',
            'kriteria_id.exists' => 'Kriteria ID must exist in the kriteria table',
            'jenis_kriteria_id.required' => 'Jenis Kriteria ID is required',
            'jenis_kriteria_id.integer' => 'Jenis Kriteria ID must be an integer',
            'jenis_kriteria_id.exists' => 'Jenis Kriteria ID must exist in the jenis_kriteria table',
            'status_validasi.required' => 'Status Validasi is required',
            'status_validasi.in' => 'Status Validasi must be one of: pending, accepted, rejected',
            'status_pengerjaan.required' => 'Status Pengerjaan is required',
            'status_pengerjaan.in' => 'Status Pengerjaan must be one of: save, submitted, revised',
        ];
    }
}
