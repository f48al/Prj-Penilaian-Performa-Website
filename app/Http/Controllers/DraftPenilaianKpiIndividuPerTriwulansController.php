<?php

namespace App\Http\Controllers;

use App\Models\DraftPenilaianKpiIndividuPerTriwulans;
use App\Http\Requests\DraftPenilaianKpiIndividuPerTriwulansRequest;

class DraftPenilaianKpiIndividuPerTriwulansController extends Controller
{
    public function index() {
        return view('#');
    }

    public function show($id) {
        $data = DraftPenilaianKpiIndividuPerTriwulans::findOrFail($id);

        return view('#', $data);
    }

    public function create(DraftPenilaianKpiIndividuPerTriwulansRequest $request) {
        $validated = $request->validated();
        DraftPenilaianKpiIndividuPerTriwulans::create($validated);

        return redirect()->route('#')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id) {
        $data = DraftPenilaianKpiIndividuPerTriwulans::findOrFail($id);

        return view('#', compact('data'));
    }

    public function update(DraftPenilaianKpiIndividuPerTriwulansRequest $request, $id) {
        $validated = $request->validated();
        DraftPenilaianKpiIndividuPerTriwulans::findOrFail($id)->update($validated);

        return redirect()->route('#')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id) {
        DraftPenilaianKpiIndividuPerTriwulans::destroy($id);

        return redirect()->route('#')->with('success', 'Data berhasil dihapus');
    }
}
