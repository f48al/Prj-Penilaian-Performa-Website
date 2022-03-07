<?php

namespace App\Http\Controllers;

use App\Models\StaffLevel3;
use App\Http\Requests\StaffLevel3Request;

class StaffLevel3Controller extends Controller
{
    public function index()
    {
        return view('#');
    }

    public function show($id)
    {
        $data = StaffLevel3::findOrFail($id);

        return view('#', $data);
    }

    public function create(StaffLevel3Request $request)
    {
        $validated = $request->validated();
        StaffLevel3::create($validated);

        return redirect()->route('#')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = StaffLevel3::findOrFail($id);

        return view('#', compact('data'));
    }

    public function updated(StaffLevel3Request $request, $id)
    {
        $validated = $request->validated();
        StaffLevel3::findOrFail($id)->update($validated);

        return redirect()->route('#')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        StaffLevel3::findOrFail($id)->delete();

        return redirect()->route('#')->with('success', 'Data berhasil dihapus');
    }
}
