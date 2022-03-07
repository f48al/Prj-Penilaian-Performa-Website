<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ {
    User,
    Profile,
    TargetKinerja,
    TargetTriwulan1,
    TargetTriwulan2,
    TargetTriwulan3,
    TargetTriwulan4,
    DraftKpiIndividu,
    FormPenyusunanKpi,
};

class FormPenyusunanKpiController extends Controller
{
    public function index(Request $request, $year = null)
    {
        // validation format URL parameter
        $validator = Validator::make(['year' => $year], [
            'year' => 'nullable|date_format:Y'
        ]);
        if ($validator->fails()) return response()->json($validator->errors(), 422);

        $year = $year ?? date('Y');

        if($request->ajax()) { // handle ajax request
            $datas = User::role('Karyawan')
                ->join('profiles', 'profiles.user_id', 'users.id')
                ->select([
                    'profiles.id',
                    'profiles.NPK',
                    'users.name',
                    'profiles.namaJabatan',
                ])->get();

            $modified_data = datatables()->of($datas)
                ->addColumn('dkpiid', function ($data) use (&$year) {
                    $form = FormPenyusunanKpi::where([
                        ['tahunKinerja', $year],
                        ['profile_id', $data->id]
                    ]);

                    if (!$form->exists()) {
                        return '<a class="btn btn-sm btn-primary rounded-pill" href="
                                '. route('penyusunan-kpi.form', ['profile_id' => $data->id, 'year' => $year]) .'
                            " role="button" style="font-size:10px;">Tambah</a>';
                    }
                    $dkpiid = $form->first()->dkpiid;
                    return '<a class="link-primary" href="'. route('penyusunan-kpi.show', $dkpiid) .'">'.$dkpiid.'</a>';
                })
                ->addColumn('status_penyusunan', function ($data) use (&$year) {
                    $form = FormPenyusunanKpi::where([
                        ['tahunKinerja', $year],
                        ['profile_id', $data->id]
                    ])->first();
                    if (!$form || !$form->status_penyusunan) {
                        return '<span class="badge bg-danger">Belum</span>';
                    } else {
                        return '<span class="badge bg-success">Sudah</span>';
                    }
                })
                ->rawColumns(['dkpiid', 'status_penyusunan'])
                ->make(true);

            return response()->json($modified_data, 200);
        }

        return view('Pages.penyusunanKPI', compact('year'));
    }

    public function create($profile_id, $year)
    {
        // validation format URL parameter
        $validator = Validator::make([
            'year' => $year,
            'profile_id' => $profile_id
        ], [
            'year' => 'required|date_format:Y',
            'profile_id' => 'required|exists:profiles,id'
        ]);
        if ($validator->fails()) return response()->json($validator->errors(), 422);

        $form = FormPenyusunanKpi::where([
            ['tahunKinerja', $year],
            ['profile_id', $profile_id]
        ])->first();

        // bila user sudah mengisi form penyusunan KPI, abort 404
        if($form) abort(404);

        $profile = User::role('Karyawan')
            ->join('profiles', 'profiles.user_id', 'users.id')
            ->select([
                'users.name',
                'profiles.id',
                'profiles.NPK',
                'profiles.unitKerja',
                'profiles.namaJabatan',
            ])->where('profiles.id', $profile_id)->first();

        $kpis = DraftKpiIndividu::where('tahunKinerja', $year)->get();

        return view('Pages.penyusunanForm.create', compact('profile', 'kpis', 'year'));
    }

    public function show($dkpiid)
    {
        $form = FormPenyusunanKpi::where('dkpiid', $dkpiid)->first();
        if(!$form) return abort(404);
        $targets = TargetKinerja::where('penyusunanKPI_id', $form->idPenyusunanKPI)->get();
        $profile = Profile::findOrFail($form->profile_id);

        return view('Pages.penyusunanForm.show', compact('profile', 'form', 'targets'));
    }

    public function store(Request $requests)
    {
        // validate data di form table
        for($i = 0; $i < 8; $i++) {
            $request = $requests->data[$i];

            $validator = Validator::make($request, [
                'iddkpi'            => 'required|exists:draft_kpi_individus,iddKPI',
                'skala'             => 'required|numeric',
                'bobot'             => 'required|numeric',
                'targetTriwulan1'   => 'required|numeric',
                'targetTriwulan2'   => 'required|numeric',
                'targetTriwulan3'   => 'required|numeric',
                'targetTriwulan4'   => 'required|numeric',
            ]);

            if($validator->fails()) return response()->json($validator->errors(), 422);
        }

        $additional_data = $requests->data[8]['additional_data'];
        // validate additional data
        $validator = Validator::make($additional_data, [
            'tahunKinerja'      => 'required|date_format:Y',
            'profile_id'        => 'required|exists:profiles,id',
            'catatan'           => 'required|string',
        ]);

        if($validator->fails()) return response()->json($validator->errors(), 422);

        // store data
        $form = FormPenyusunanKpi::create([
            'dkpiid'           => 'DKPI'. rand(100000, 999999),
            'profile_id'       => $additional_data['profile_id'],
            'tahunKinerja'     => $additional_data['tahunKinerja'],
            'catatan'          => $additional_data['catatan'],
        ]);

        for($i = 0; $i < 8; $i++) {
            $request = $requests->data[$i];

            $target_kinerja = TargetKinerja::create([
                'penyusunanKPI_id'  => $form->idPenyusunanKPI,
                'iddKPI'            => $request['iddkpi'],
                'skala'             => $request['skala'] ?? 0,
                'bobot'             => $request['bobot'] ?? 0,
            ]);

            TargetTriwulan1::create([
                'target_kinerja_id' => $target_kinerja->id,
                'target'            => $request['targetTriwulan1'] ?? 0,
            ]);

            TargetTriwulan2::create([
                'target_kinerja_id' => $target_kinerja->id,
                'target'            => $request['targetTriwulan2'] ?? 0,
            ]);

            TargetTriwulan3::create([
                'target_kinerja_id' => $target_kinerja->id,
                'target'            => $request['targetTriwulan3'] ?? 0,
            ]);

            TargetTriwulan4::create([
                'target_kinerja_id' => $target_kinerja->id,
                'target'            => $request['targetTriwulan4'] ?? 0,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ], 200);
    }

    public function edit($dkpiid)
    {
        $form = FormPenyusunanKpi::where('dkpiid', $dkpiid)->first();
        if(!$form) return abort(404);
        $targets = TargetKinerja::where('penyusunanKPI_id', $form->idPenyusunanKPI)->get();
        $kpis = DraftKpiIndividu::where('tahunKinerja', $form->tahunKinerja)->get();
        $profile = User::role('Karyawan')
            ->join('profiles', 'profiles.user_id', 'users.id')
            ->select([
                'users.name',
                'profiles.id',
                'profiles.NPK',
                'profiles.unitKerja',
                'profiles.namaJabatan',
            ])->where('profiles.id', $form->profile_id)->first();

        return view('Pages.penyusunanForm.edit', compact('form', 'profile', 'kpis', 'targets'));
    }

    public function update(Request $requests, $idPenyusunanKPI)
    {
        // validate data di form table
        for($i = 0; $i < 8; $i++) {
            $request = $requests->data[$i];

            $validator = Validator::make($request, [
                'iddkpi'            => 'required|exists:draft_kpi_individus,iddKPI',
                'skala'             => 'required|numeric',
                'bobot'             => 'required|numeric',
                'targetTriwulan1'   => 'required|numeric',
                'targetTriwulan2'   => 'required|numeric',
                'targetTriwulan3'   => 'required|numeric',
                'targetTriwulan4'   => 'required|numeric',
            ]);

            if($validator->fails()) return response()->json($validator->errors(), 422);
        }

        $additional_data = $requests->data[8];
        // validate additional data
        $validator = Validator::make($additional_data, ['catatan' => 'required|string']);

        if($validator->fails()) return response()->json($validator->errors(), 422);

        // store data
        FormPenyusunanKpi::findOrFail($idPenyusunanKPI)->update([
            'catatan' => $additional_data['catatan'],
        ]);

        for($i = 0; $i < 8; $i++) {
            $request = $requests->data[$i];

            TargetKinerja::find($request['id'])->update([
                'iddKPI'            => $request['iddkpi'],
                'skala'             => $request['skala'] ?? 0,
                'bobot'             => $request['bobot'] ?? 0,
            ]);

            TargetTriwulan1::where('target_kinerja_id', $request['id'])->update([
                'target' => $request['targetTriwulan1'] ?? 0,
            ]);

            TargetTriwulan2::where('target_kinerja_id', $request['id'])->update([
                'target' => $request['targetTriwulan2'] ?? 0,
            ]);

            TargetTriwulan3::where('target_kinerja_id', $request['id'])->update([
                'target' => $request['targetTriwulan3'] ?? 0,
            ]);

            TargetTriwulan4::where('target_kinerja_id', $request['id'])->update([
                'target' => $request['targetTriwulan4'] ?? 0,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Perubahan berhasil disimpan'
        ], 200);
    }

    public function destroy($id)
    {
        abort(404);
        FormPenyusunanKpi::destroy($id);

        return redirect()->route('#')->with('success', 'Data berhasil dihapus');
    }
}
