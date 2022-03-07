<?php

namespace App\Http\Controllers;

use App\Models\StaffLevel2;
use App\Http\Requests\StaffLevel2Request;

class StaffLevel2Controller extends Controller
{
    public function index()
    {
        return view('#');
    }

    public function show($id)
    {
        $data = StaffLevel2::findOrFail($id);

        return view('#', $data);
    }

    public function create(StaffLevel2Request $request)
    {
        $validated = $request->validated();
        StaffLevel2::create($validated);

        return redirect()->route('#')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = StaffLevel2::findOrFail($id);

        return view('#', compact('data'));
    }

    public function updated(StaffLevel2Request $request, $id)
    {
        $validated = $request->validated();
        StaffLevel2::findOrFail($id)->update($validated);

        return redirect()->route('#')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        StaffLevel2::findOrFail($id)->delete();

        return redirect()->route('#')->with('success', 'Data berhasil dihapus');
    }
}
