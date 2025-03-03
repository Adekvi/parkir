<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Parker;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $parker = Parker::with('user', 'shift')->get();

        return view('user.index', compact('parker'));
    }

    public function tambah(Request $request){
        $request->validate([
            'id_user' => 'required',
            'id_shift' => 'required',
            'tglParkir' => 'required',
            'nopol' => 'required',
            'penerimaan' => 'required',
            'status' => 'required',
        ]);

        $id_user = User::where('id', $request->id_user)->first();
        $id_shift = Shift::where('id', $request->id_shift)->first();

        $data = [
            'id_user' => $id_user->id,
            'id_shift' => $id_shift->id,
            'tglParkir' => $request->tglParkir,
            'nopol' => $request->nopol,
            'penerimaan' => $request->penerimaan,
            'status' => $request->status
        ];

        dd($data);

        Parker::create($data);

        return redirect()->route('user.index')->with('success', 'Data berhasil ditambahkan');

    }
}
