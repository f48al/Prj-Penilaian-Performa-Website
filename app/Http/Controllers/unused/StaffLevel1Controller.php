<?php

namespace App\Http\Controllers;

use App\Models\StaffLevel1;
use App\Http\Requests\StaffLevel1Request;

class StaffLevel1Controller extends Controller
{
    public function index() {
        return view('#');
    }

    public function show($id) {
        $data = StaffLevel1::findOrFail($id);

        return view('#', $data);
    }

    public function create(StaffLevel1Request $request) {
        $validated = $request->validated();
        StaffLevel1::create($validated);

        return redirect()->route('#')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id) {
        $data = StaffLevel1::findOrFail($id);

        return view('#', compact('data'));
    }

    public function updated(StaffLevel1Request $request, $id) {
        $validated = $request->validated();
        StaffLevel1::findOrFail($id)->update($validated);

        return redirect()->route('#')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id) {
        StaffLevel1::findOrFail($id)->delete();

        return redirect()->route('#')->with('success', 'Data berhasil dihapus');
    }
}
