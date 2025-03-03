<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Jalan;
use App\Models\JamLokasi;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $kolektorCount = User::where('role', 'kolektor')->count();
        $userCount = User::where('role', 'user')->count();
        $jalanCount = Jalan::count(); // Asumsi Anda memiliki model Jalan
        $lokasiParkirCount = JamLokasi::count(); // Asumsi Anda memiliki model LokasiParkir

        return view('kasir.index', compact('kolektorCount', 'userCount', 'jalanCount', 'lokasiParkirCount'));
    }

}
