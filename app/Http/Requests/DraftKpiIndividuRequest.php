<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DraftKpiIndividuRequest extends FormRequest
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
            'indikatorKunciKerja'   => 'required',
            'perspektif'            => 'required',
            'tujuanStrategis'       => 'required',
            'glosary'               => 'required',
            'formula'               => 'required',
            'tahunKinerja'          => 'required|date_format:Y'
        ];
    }

    public function messages() {
        return [
            'indikatorKunciKerja.required'   => 'Indikator Kunci Kerja harus diisi',
            'perspektif.required'            => 'Perspektif harus diisi',
            'tujuanStrategis.required'       => 'Tujuan Strategis harus diisi',
            'glosary.required'               => 'Glosary harus diisi',
            'formula.required'               => 'Formula harus diisi',
            'tahunKinerja.required'          => 'Tahun Kinerja harus diisi',
            'tahunKinerja.date_format'       => 'Format Tahun Kinerja harus YYYY'
        ];
    }
}
