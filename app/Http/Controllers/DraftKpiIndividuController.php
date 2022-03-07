<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DraftKpiIndividu;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DraftKpiIndividuImport;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\DraftKpiIndividuRequest;

class DraftKpiIndividuController extends Controller
{
    public function index(Request $request, $year = null)
    {
        // validation format URL parameter
        $validator = Validator::make(['year' => $year], [
            'year' => 'nullable|date_format:Y'
        ]);
        if($validator->fails()) return $validator->errors();

        $year = $year ?? date('Y');

        if($request->ajax()) { // handle ajax request
            $draftKpiIndividu = DraftKpiIndividu::where('tahunKinerja', $year)->get();

            $modified_data = datatables()->of($draftKpiIndividu)
                // menambahkan action column
                ->addColumn('action', function($draftKpiIndividu) {
                    return
                        '<div class="d-flex gap-3">
                            <img src="'. asset('plugin/images/2__listindikator-page/u175.svg') .'" class="img-icon" onclick="edit('. $draftKpiIndividu->iddKPI .')" style="cursor: pointer;"/>
                            <img src="'. asset('plugin/images/2__listindikator-page/u177.svg') .'" class="img-icon" onclick="destroy('. $draftKpiIndividu->iddKPI .')" style="cursor: pointer;"/>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make(true);

            return response()->json($modified_data, 200);
        }

        return view('Pages.addKPI', compact('year'));
    }

    public function show($id)
    {
        abort(404);
    }

    public function create()
    {
        return view('Pages.addKPIForm');
    }

    public function store(Request $requests) {
        if(!$requests->ajax()) abort(404);

        // mengecek jumlah kolom yang dikirim tidak boleh lebih dari 10
        if(count($requests->except('_token')['data']) > 10) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak boleh lebih dari 10 kolom'
            ], 422);
        }

        foreach($requests->data as $request) {
            $validator = Validator::make($request, [
                'indikatorKunciKerja'   => 'required|string',
                'perspektif'            => 'required|string',
                'tujuanStrategis'       => 'required|string',
                'glosary'               => 'required|string',
                'formula'               => 'required|string',
                'tahunKinerja'          => 'required|date_format:Y'
            ]);

            if($validator->fails()) return $validator->errors();

            DraftKpiIndividu::create([
                'indikatorKunciKerja'   => $request['indikatorKunciKerja'],
                'perspektif'            => $request['perspektif'],
                'tujuanStrategis'       => $request['tujuanStrategis'],
                'glosary'               => $request['glosary'],
                'formula'               => $request['formula'],
                'tahunKinerja'          => $request['tahunKinerja']
            ]);
        }

        return response()->json(['success' => 'Data berhasil ditambahkan'], 200);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:5120'
        ]);

        $file = $request->file('file');

        Excel::import(new DraftKpiIndividuImport, $file);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diimport'
        ], 200);
    }

    public function edit(Request $request, $iddKPI)
    {
        if(!$request->ajax()) abort(404);

        $data = collect(DraftKpiIndividu::findOrFail($iddKPI))->except(['created_at', 'updated_at']);
        return response()->json($data, 200);
    }

    public function update(DraftKpiIndividuRequest $request, $iddKPI)
    {
        $validated = $request->validated();
        DraftKpiIndividu::findOrFail($iddKPI)->update($validated);

        return response('Berhasil diubah', 200);
    }

    public function destroy($iddKPI)
    {
        DraftKpiIndividu::findOrFail($iddKPI)->delete();

        return response('Berhasil dihapus', 200);
    }
}
