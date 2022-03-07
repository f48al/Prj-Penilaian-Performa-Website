<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetKinerja extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function draftKpiIndividu()
    {
        return $this->hasOne(DraftKpiIndividu::class, 'iddKPI', 'iddKPI');
    }

    public function targetTriwulan1()
    {
        return $this->hasOne(TargetTriwulan1::class, 'target_kinerja_id', 'id');
    }

    public function targetTriwulan2()
    {
        return $this->hasOne(TargetTriwulan2::class, 'target_kinerja_id', 'id');
    }

    public function targetTriwulan3()
    {
        return $this->hasOne(TargetTriwulan3::class, 'target_kinerja_id', 'id');
    }

    public function targetTriwulan4()
    {
        return $this->hasOne(TargetTriwulan4::class, 'target_kinerja_id', 'id');
    }

    public function formPenyusunanKpi()
    {
        return $this->belongsTo(FormPenyusunanKpi::class, 'penyusunanKPI_id', 'idPenyusunanKPI');
    }
}
