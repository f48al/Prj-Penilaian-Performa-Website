<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffLevel2Request extends FormRequest
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
            'nama'                  => 'required|string|max:100',
            'namaJabatan'           => 'required|string',
            'unitKerja'             => 'required|string',
            'tanggalLahir'          => 'required|date',
            'tanggalMulaiJabatan'   => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'nama.required'                 => 'Nama tidak boleh kosong',
            'nama.string'                   => 'Nama harus berupa string',
            'nama.max'                      => 'Nama tidak boleh lebih dari 100 karakter',
            'namaJabatan.required'          => 'Nama jabatan tidak boleh kosong',
            'namaJabatan.string'            => 'Nama jabatan harus berupa string',
            'unitKerja.required'            => 'Unit kerja tidak boleh kosong',
            'unitKerja.string'              => 'Unit kerja harus berupa string',
            'tanggalLahir.required'         => 'Tanggal lahir tidak boleh kosong',
            'tanggalLahir.date'             => 'Tanggal lahir tidak valid',
            'tanggalMulaiJabatan.required'  => 'Tanggal mulai jabatan tidak boleh kosong',
            'tanggalMulaiJabatan.date'      => 'Tanggal mulai jabatan tidak valid',
        ];
    }
}
