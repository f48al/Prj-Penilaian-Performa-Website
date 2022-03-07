<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPenyusunanKpi extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'idPenyusunanKPI';

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }

    public function targetKinerjas()
    {
        return $this->hasMany(TargetKinerja::class, 'penyusunanKPI_id', 'idPenyusunanKPI');
    }
}
