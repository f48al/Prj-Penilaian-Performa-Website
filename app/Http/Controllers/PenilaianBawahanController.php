<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TargetTriwulan1;
use App\Models\TargetTriwulan2;
use App\Models\TargetTriwulan3;
use App\Models\TargetTriwulan4;
use App\Models\FormPenyusunanKpi;
use Illuminate\Support\Facades\Validator;

class PenilaianBawahanController extends Controller
{
    public function index($year = null)
    {
        $validator = Validator::make(['year' => $year], [
            'year' => 'nullable|date_format:Y',
        ]);
        if($validator->fails()) return response()->json(['error' => $validator->errors()], 422);

        $year = $year ?? date('Y');

        $datas = User::role('Karyawan')->whereHas('profile', function($query) use ($year) {
            $query->whereHas('formPenyusunanKpis', function($query) use ($year) {
                $query->where([
                    ['tahunKinerja', $year],
                    ['status_penyusunan', 1]
                ]);
            });
        })->get();

        return view('Pages.penilaianBawahan', compact('datas', 'year'));
    }

    public function create($idPenyusunanKPI, $ke)
    {
        $data = FormPenyusunanKpi::findOrFail($idPenyusunanKPI);

        if($ke == '1') {
            $triwulan = 'Triwulan I';
        } elseif ($ke == '2') {
            $triwulan = 'Triwulan II';
        } elseif ($ke == '3') {
            $triwulan = 'Triwulan III';
        } else {
            $triwulan = 'Triwulan IV';
        }

        return view('Pages.penilaianBawahan.create', compact('data', 'triwulan', 'ke'));
    }

    public function store(Request $request, $triwulan)
    {
        if($triwulan == '1') {
            $target_triwulan = TargetTriwulan1::where('target_kinerja_id', $request->target_kinerja_id);
        } elseif($triwulan == '2') {
            $target_triwulan = TargetTriwulan2::where('target_kinerja_id', $request->target_kinerja_id);
        } elseif($triwulan == '3') {
            $target_triwulan = TargetTriwulan3::where('target_kinerja_id', $request->target_kinerja_id);
        } else {
            $target_triwulan = TargetTriwulan4::where('target_kinerja_id', $request->target_kinerja_id);
        }

        $request->validate([
            'realisasiAtasan' => 'required|numeric|min:0',
        ]);

        $target_triwulan->update([
            'realisasi_atasan' => $request->realisasiAtasan,
        ]);
    }
}
