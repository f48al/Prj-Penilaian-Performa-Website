<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FormPenyusunanKpi;
use Illuminate\Support\Facades\Validator;

class ReviewPenilaianController extends Controller
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

        return view('Pages.revPenilaianBawahan', compact('datas', 'year'));
    }

    public function show($idPenyusunanKPI, $ke)
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

        return view('Pages.revPenilaian.show', compact('data', 'triwulan', 'ke'));
    }

    public function update($idPenyusunanKPI, $triwulan)
    {
        $form = FormPenyusunanKpi::findOrFail($idPenyusunanKPI);

        if($triwulan == '1') {
            $form->status_triwulan1 = 1;
        } elseif($triwulan == '2') {
            $form->status_triwulan2 = 1;
        } elseif($triwulan == '3') {
            $form->status_triwulan3 = 1;
        } elseif($triwulan == '4') {
            $form->status_triwulan4 = 1;
        } else {
            abort(404);
        }
        $form->save();

        return redirect()->route('review-penilaian.index');
    }
}
