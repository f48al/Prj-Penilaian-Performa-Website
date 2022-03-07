<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormPenilaianKpiRequest extends FormRequest
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
            'iddpenilaian'  => 'required|exist:draft_penliaian_kpi_individu_per_triwulans,iddPeniliaian',
            'idshcp'        => 'required|exist:staff_hcps,idshcp',
            'idsl1'         => 'required|exist:staff_level1s,idsl1',
            'idsl2'         => 'required|exist:staff_level2s,idsl2',
            'idsl3'         => 'required|exist:staff_level3s,idsl3',
            'idsl4'         => 'required|exist:staff_level4s,idsl4',
            'status'        => 'required|string',
            'tanggalRespon' => 'required|date',
            'catatan'       => 'required|string',
        ];
    }

    public function messages() {
        return [
            'iddpenilaian.required'     => 'ID Penilaian harus diisi',
            'iddpenilaian.exist'        => 'ID Penilaian tidak ditemukan',
            'idshcp.required'           => 'ID SHCP harus diisi',
            'idshcp.exist'              => 'ID SHCP tidak ditemukan',
            'idsl1.required'            => 'ID SL1 harus diisi',
            'idsl1.exist'               => 'ID SL1 tidak ditemukan',
            'idsl2.required'            => 'ID SL2 harus diisi',
            'idsl2.exist'               => 'ID SL2 tidak ditemukan',
            'idsl3.required'            => 'ID SL3 harus diisi',
            'idsl3.exist'               => 'ID SL3 tidak ditemukan',
            'idsl4.required'            => 'ID SL4 harus diisi',
            'idsl4.exist'               => 'ID SL4 tidak ditemukan',
            'status.required'           => 'Status harus diisi',
            'status.string'             => 'Status harus berupa string',
            'tanggalRespon.required'    => 'Tanggal Respon harus diisi',
            'tanggalRespon.date'        => 'Tanggal Respon harus berupa tanggal',
            'catatan.required'          => 'Catatan harus diisi',
            'catatan.string'            => 'Catatan harus berupa string',
        ];
    }
}
