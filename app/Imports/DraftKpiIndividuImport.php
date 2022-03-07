<?php

namespace App\Imports;

use App\Models\DraftKpiIndividu;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DraftKpiIndividuImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DraftKpiIndividu([
            'perspektif'            => $row['perspektif'],
            'tujuanStrategis'       => $row['tujuan_strategis'],
            'indikatorKunciKerja'   => $row['indikator_kunci_kerja'],
            'glosary'               => $row['glosary'],
            'formula'               => $row['formula'],
            'tahunKinerja'          => $row['tahun_kinerja']
        ]);
    }
}
