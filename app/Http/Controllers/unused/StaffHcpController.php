<?php

namespace App\Http\Controllers;

use App\Models\StaffHcp;
use App\Http\Requests\StaffHcpRequest;

class StaffHcpController extends Controller
{
    public function index() {
        return view('#');
    }

    public function show($id) {
        $data = StaffHcp::findOrFail($id);

        return view('#', $data);
    }

    public function create(StaffHcpRequest $request) {
        $validated = $request->validated();
        StaffHcp::create($validated);

        return redirect()->route('#')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id) {
        $data = StaffHcp::findOrFail($id);

        return view('#', compact('data'));
    }

    public function update(StaffHcpRequest $request, $id) {
        $validated = $request->validated();
        StaffHcp::findOrFail($id)->update($validated);

        return redirect()->route('#')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id) {
        StaffHcp::findOrFail($id)->delete();

        return redirect()->route('#')->with('success', 'Data berhasil dihapus');
    }
}
