<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetTriwulan2 extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function targetKinerja()
    {
        return $this->belongsTo(TargetKinerja::class, 'target_kinerja_id', 'id');
    }
}
