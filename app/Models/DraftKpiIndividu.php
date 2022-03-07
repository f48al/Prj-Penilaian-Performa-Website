<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftKpiIndividu extends Model
{
    use HasFactory;

    protected $primaryKey = 'iddKPI';

    protected $guarded = ['iddKPI', 'created_at', 'updated_at'];

    public function targetKinerja()
    {
        return $this->belongsTo(TargetKinerja::class, 'iddKPI', 'iddKPI');
    }
}
