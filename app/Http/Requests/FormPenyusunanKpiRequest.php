<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormPenyusunanKpiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'profile_id'    => 'required|exists:profiles,id',
            'status'        => 'required|boolean',
            'tanggalRespon' => 'nullable|date',
            'catatan'       => 'nullable|string',
            'tahunKinerja'  => 'nullable|integer'
        ];
    }

    public function messages()
    {
        return [
            'profile_id.required'    => 'ID Profile harus diisi',
            'profile_id.exists'      => 'ID Profile tidak ditemukan',
            'status.required'        => 'Status harus diisi',
            'status.boolean'         => 'Status harus berupa boolean',
            'tanggalRespon.date'     => 'Tanggal Respon harus berupa tanggal',
            'catatan.string'         => 'Catatan harus berupa string',
            'tahunKinerja.integer'   => 'Tahun Kinerja harus berupa integer'
        ];
    }
}
