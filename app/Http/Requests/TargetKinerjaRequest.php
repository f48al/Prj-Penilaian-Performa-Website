<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TargetKinerjaRequest extends FormRequest
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
            'penyusunanKPI_id'  => 'required|exists:form_penyusunan_kpis,idPenyusunanKPI',
            'skala'             => 'required|string',
            'bobot'             => 'required|numeric',
            'targetTriwulan1'   => 'required|numeric',
            'targetTriwulan2'   => 'required|numeric',
            'targetTriwulan3'   => 'required|numeric',
            'targetTriwulan4'   => 'required|numeric',
        ];
    }
}
