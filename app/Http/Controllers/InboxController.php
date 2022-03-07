<?php

namespace App\Http\Controllers;

use App\Models\Inbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InboxController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Inbox::where('user_id', Auth::id())->get();

            $modified_data = datatables($data)
                ->addColumn('inbox', function($data) {
                    return "Anda memiliki <b class='text-danger'>{$data->jumlah} {$data->jenis}</b> yang belum dibaca";
                })
                ->editColumn('tanggal', function($data) {
                    return date('d M Y', strtotime($data->tanggal));
                })
                ->rawColumns(['inbox'])
                ->make(true);
            return $modified_data;
        }

        return view('Pages.inbox');
    }

    public function store(Request $request, $user_id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
}
