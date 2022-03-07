<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DraftPenilaianKpiIndividuPerTriwulansRequest extends FormRequest
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
            'iddkpi'                => 'required|exists:draft_kpi_individus,iddkpi',
            'waktuTriwulan'         => 'required|string',
            'indikatorKunciKerja'   => 'required|string',
            'perspektif'            => 'required|string',
            'tujuanStrategis'       => 'required|string',
            'skala'                 => 'required|integer',
            'bobot'                 => 'required|integer',
            'filePendukung'         => 'nullable|string',
            'realisasiKaryawan'     => 'required|integer',
            'realisasiAtasan'       => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'iddkpi.required'                => 'ID KPI tidak boleh kosong',
            'iddkpi.exists'                  => 'ID KPI tidak ditemukan',
            'waktuTriwulan.required'         => 'Waktu Triwulan tidak boleh kosong',
            'waktuTriwulan.string'           => 'Waktu Triwulan harus berupa string',
            'indikatorKunciKerja.required'   => 'Indikator Kunci Kerja tidak boleh kosong',
            'indikatorKunciKerja.string'     => 'Indikator Kunci Kerja harus berupa string',
            'perspektif.required'            => 'Perspektif tidak boleh kosong',
            'perspektif.string'              => 'Perspektif harus berupa string',
            'tujuanStrategis.required'       => 'Tujuan Strategis tidak boleh kosong',
            'tujuanStrategis.string'         => 'Tujuan Strategis harus berupa string',
            'skala.required'                 => 'Skala tidak boleh kosong',
            'skala.integer'                  => 'Skala harus berupa integer',
            'bobot.required'                 => 'Bobot tidak boleh kosong',
            'bobot.integer'                  => 'Bobot harus berupa integer',
            'filePendukung.string'           => 'File Pendukung harus berupa string',
            'realisasiKaryawan.required'     => 'Realisasi Karyawan tidak boleh kosong',
            'realisasiKaryawan.integer'      => 'Realisasi Karyawan harus berupa integer',
            'realisasiAtasan.required'       => 'Realisasi Atasan tidak boleh kosong',
            'realisasiAtasan.integer'        => 'Realisasi Atasan'
        ];
    }
}
