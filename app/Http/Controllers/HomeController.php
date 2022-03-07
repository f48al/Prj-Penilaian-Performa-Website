<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DraftPenilaianKpiIndividuPerTriwulans;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index() {
        $month_now = date('m');

        if($month_now >= 1 && $month_now <= 3) {
            $triwulan = 'I';
        } else if($month_now >= 4 && $month_now <= 6) {
            $triwulan = 'II';
        } else if($month_now >= 7 && $month_now <= 9) {
            $triwulan = 'III';
        } else if($month_now >= 10 && $month_now <= 12) {
            $triwulan = 'IV';
        }

        return redirect()->route('home-kinerja', ['triwulan' => $triwulan, 'year' => date('Y')]);
    }

    public function kinerja(Request $request, $triwulan, $year) {
        // validation format URL parameter
        $validator = Validator::make(['triwulan' => $triwulan, 'year' => $year], [
            'triwulan' => 'required|in:I,II,III,IV',
            'year' => 'required|date_format:Y'
        ]);
        if($validator->fails()) return abort(404);

        $pkipt = DraftPenilaianKpiIndividuPerTriwulans::where('waktuTriwulan', $triwulan)
            ->whereYear('created_at', $year)->get();

        if($triwulan == 'I') {
            $triwulan_text = 'Tahun ' . $year . ' (Januari - Maret)';
        } else if($triwulan == 'II') {
            $triwulan_text = 'Tahun ' . $year . ' (April - Juni)';
        } else if($triwulan == 'III') {
            $triwulan_text = 'Tahun '.$year.' (Juli - September)';
        } else if($triwulan == 'IV') {
            $triwulan_text = 'Tahun ' . $year . ' (Oktober - Desember)';
        }

        if ($request->ajax()) { // handle ajax request
            $modified_data = datatables()->of($pkipt)
                ->addColumn('action', function ($pkipt) {
                    if ($pkipt->filePendukung) {
                        // menambahkan action column
                        $action = '<div class="d-flex gap-3">
                            <a href="' . asset($pkipt->filePendukung) . '"><img src="' . asset('plugin/images/1__home-page/u57.svg') . '" class="img-icon" style="cursor: pointer;"/></a>
                            <img src="' . asset('plugin/images/1__home-page/u58.svg') . '" class="img-icon" onclick="upload(' . $pkipt->iddPenilaian . ')" style="cursor: pointer;"/>
                            </div>';
                    } else {
                        $action = '<img src="' . asset('plugin/images/1__home-page/u58.svg') . '" class="img-icon" onclick="upload(' . $pkipt->iddPenilaian . ')" style="cursor: pointer;"/>';
                    }
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);

            return response()->json($modified_data, 200);
        }

        return view('Pages/home', compact('triwulan', 'triwulan_text', 'year'));
    }

    public function upload(Request $request) {
        $request->validate([
            '_iddPenilaian' => 'required',
            'filePendukung' => 'required|file|max:100000',
        ]);

        $pkipt = DraftPenilaianKpiIndividuPerTriwulans::findOrFail($request->_iddPenilaian);

        // cek bila file sudah ada
        if($pkipt->filePendukung) {
            $file = public_path($pkipt->filePendukung);
            if(file_exists($file)) {
                unlink($file); // hapus file nya
            }
        }

        $file = $request->file('filePendukung');
        $fileName = $file->hashName();
        $file->move(public_path('assets/PenilaianKPIIndividu/filePendukung'), $fileName);
        $path = 'assets/PenilaianKPIIndividu/filePendukung/' . $fileName;

        $pkipt->filePendukung = $path;
        $pkipt->save();

        if($request->ajax()) {
            return response()->json(asset($path), 200);
        }
        return redirect()->back()->with('success', asset($path));
    }
}
