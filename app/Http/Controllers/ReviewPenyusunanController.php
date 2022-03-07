<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FormPenyusunanKpi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewPenyusunanController extends Controller
{
    public function index(Request $request, $year = null)
    {
        // validation format URL parameter
        $validator = Validator::make(['year' => $year],  [
            'year' => 'nullable|date_format:Y'
        ]);
        if ($validator->fails()) return response()->json($validator->errors(), 400);

        $year = $year ?? date('Y');

        if($request->ajax()) { // handle ajax request
            $datas = FormPenyusunanKpi::where('tahunKinerja', $year)->get()->load('profile');

            $modified_data = datatables()->of($datas)
                ->editColumn('dkpiid', function($data) {
                    return '<a class="link-primary" href="'. route('penyusunan-kpi.show', $data->dkpiid) .'">'.$data->dkpiid.'</a>';
                })
                ->editColumn('status_penyusunan', function($data) {
                    return $data->status_penyusunan
                        ? '<span class="badge bg-success">Sudah</span>'
                        : '<span class="badge bg-danger">Belum</span>';
                })
                ->addColumn('name', function($data) {
                    return User::find($data->profile->user_id)->name;
                })
                ->rawColumns(['dkpiid', 'status_penyusunan'])
                ->make(true);

            return response()->json($modified_data, 200);
        }

        return view('Pages.revPenyusunan', compact('year'));
    }

    public function update($idPenyusunanKPI)
    {
        if(!Auth::user()->can('draft penyusunan KPI')) abort(404);

        FormPenyusunanKpi::findOrFail($idPenyusunanKPI)->update([
            'status_penyusunan' => true,
            'tanggalRespon'     => now()
        ]);

        return redirect()->route('review-penyusunan.index')->with('success', 'Data berhasil diperbarui');
    }
}
