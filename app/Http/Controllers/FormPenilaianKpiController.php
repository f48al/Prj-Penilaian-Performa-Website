<?php

namespace App\Http\Controllers;

use App\Models\FormPenilaianKpi;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\FormPenilaianKpiRequest;

class FormPenilaianKpiController extends Controller
{
    public function index()
    {
        return view('#');
    }

    public function show($id) {
        $data = FormPenilaianKpi::find($id);

        return view('#', $data);
    }

    public function create(FormPenilaianKpiRequest $request) {
        $validated = $request->validated();
        FormPenilaianKpi::create($validated);

        return redirect()->route('#')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id) {
        $data = FormPenilaianKpi::find($id);

        return view('#', compact('data'));
    }

    public function update(FormPenilaianKpiRequest $request, $id) {
        $validated = $request->validated();
        FormPenilaianKpi::findOrFail('id', $id)->update($validated);

        return redirect()->route('#')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id) {
        FormPenilaianKpi::destroy($id);

        return redirect()->route('#')->with('success', 'Data berhasil dihapus');
    }
}
