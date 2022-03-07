<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffLevel4Request;
use App\Models\StaffLevel4;
use Illuminate\Http\Request;

class StaffLevel4Controller extends Controller
{
    public function index()
    {
        return view('#');
    }

    public function show($id)
    {
        $data = StaffLevel4::findOrFail($id);

        return view('#', $data);
    }

    public function create(StaffLevel4Request $request)
    {
        $validated = $request->validated();
        StaffLevel4::create($validated);

        return redirect()->route('#')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = StaffLevel4::findOrFail($id);

        return view('#', compact('data'));
    }

    public function updated(StaffLevel4Request $request, $id)
    {
        $validated = $request->validated();
        StaffLevel4::findOrFail($id)->update($validated);

        return redirect()->route('#')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        StaffLevel4::findOrFail($id)->delete();

        return redirect()->route('#')->with('success', 'Data berhasil dihapus');
    }
}
