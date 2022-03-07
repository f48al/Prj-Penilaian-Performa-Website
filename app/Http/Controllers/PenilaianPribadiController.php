<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TargetKinerja;
use App\Models\TargetTriwulan1;
use App\Models\TargetTriwulan2;
use App\Models\TargetTriwulan3;
use App\Models\TargetTriwulan4;
use App\Models\FormPenyusunanKpi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PenilaianPribadiController extends Controller
{
    public function index(Request $request, $year = null)
    {
        $validator = Validator::make(['year' => $year], [
            'year' => 'nullable|date_format:Y',
        ]);
        if($validator->fails()) return response()->json(['error' => $validator->errors()], 422);

        $year = $year ?? date('Y');

        $data = FormPenyusunanKpi::where([
            ['tahunKinerja', $year],
            ['profile_id', Auth::user()->profile->id],
            ['status_penyusunan', 1]
        ])->first();

        return view('Pages.periodePenilaianPribadi', compact('year', 'data'));
    }

    public function create($idPenyusunanKPI, $ke)
    {
        $datas = TargetKinerja::join('form_penyusunan_kpis', 'form_penyusunan_kpis.idPenyusunanKPI', 'target_kinerjas.penyusunanKPI_id')
            ->select('target_kinerjas.*')
            ->where([
                ['target_kinerjas.penyusunanKPI_id', $idPenyusunanKPI],
                ['form_penyusunan_kpis.profile_id', Auth::user()->profile->id]
            ])->get();

        $tahun = $datas[0]->formPenyusunanKpi->tahunKinerja;
        if($ke == 1) {
            $triwulan = 'Triwulan I';
            $periode = 'Januari - Maret';
        } elseif ($ke == 2) {
            $triwulan = 'Triwulan II';
            $periode = 'April - Juni';
        } elseif ($ke == 3) {
            $triwulan = 'Triwulan III';
            $periode = 'Juli - September';
        } else {
            $triwulan = 'Triwulan IV';
            $periode = 'Oktober - Desember';
        }

        return view('Pages.penilaianPribadi.create', compact('datas', 'tahun', 'triwulan', 'periode', 'ke'));
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

        if($request->hasFile('filePendukung')) {
            $request->validate([
                'filePendukung' => 'file|mimes:pdf,docx,doc|max:25000'
            ]);

            if($target_triwulan->first()->filePendukung) {
                $file = public_path($target_triwulan->first()->filePendukung);
                if(file_exists($file)) {
                    unlink($file);
                }
            }

            $file = $request->file('filePendukung');
            $fileName = $file->hashName();
            $file->move(public_path('assets/PenilaianKPIIndividu/filePendukung'), $fileName);
            $path = 'assets/PenilaianKPIIndividu/filePendukung/'.$fileName;

            $target_triwulan->update([
                'filePendukung' => $path
            ]);

            return response()->json([
                'file_pendukung'    => asset($path),
                'target_kinerja_id' => $request->target_kinerja_id,
            ], 200);
        } else {
            $request->validate([
                'realisasiKaryawan' => 'nullable|numeric|min:0',
            ]);

            $target_triwulan->update([
                'realisasi_karyawan' => $request->realisasiKaryawan
            ]);
        }
    }
}
