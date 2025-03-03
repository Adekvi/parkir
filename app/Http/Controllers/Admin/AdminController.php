<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jalan;
use App\Models\JamLokasi;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        $kolektorCount = User::where('role', 'kolektor')->count();
        $userCount = User::where('role', 'user')->count();
        $jalanCount = Jalan::count(); // Asumsi Anda memiliki model Jalan
        $lokasiParkirCount = JamLokasi::count(); // Asumsi Anda memiliki model LokasiParkir

        return view('admin.index', compact('kolektorCount', 'userCount', 'jalanCount', 'lokasiParkirCount'));
    }

    // public function index()
    // {
    //     $kolektorCount = User::where('role', 'kolektor')->whereMonth('created_at', now()->month)->count();
    //     $userCount = User::where('role', 'user')->whereMonth('created_at', now()->month)->count();
    //     $jalanCount = Jalan::whereMonth('created_at', now()->month)->count();
    //     $lokasiParkirCount = JamLokasi::whereMonth('created_at', now()->month)->count();

    //     // Mendapatkan jumlah per bulan untuk beberapa bulan terakhir
    //     $kolektorCountsPerMonth = User::where('role', 'kolektor')
    //         ->selectRaw('MONTH(created_at) as month, count(*) as count')
    //         ->groupBy('month')
    //         ->orderBy('month', 'asc')
    //         ->get();

    //     $userCountsPerMonth = User::where('role', 'user')
    //         ->selectRaw('MONTH(created_at) as month, count(*) as count')
    //         ->groupBy('month')
    //         ->orderBy('month', 'asc')
    //         ->get();

    //     $jalanCountsPerMonth = Jalan::selectRaw('MONTH(created_at) as month, count(*) as count')
    //         ->groupBy('month')
    //         ->orderBy('month', 'asc')
    //         ->get();

    //     $lokasiParkirCountsPerMonth = JamLokasi::selectRaw('MONTH(created_at) as month, count(*) as count')
    //         ->groupBy('month')
    //         ->orderBy('month', 'asc')
    //         ->get();

    //     return view('admin.index', compact(
    //         'userCount',
    //         'kolektorCount',
    //         'jalanCount',
    //         'lokasiParkirCount',
    //         'kolektorCountsPerMonth',
    //         'userCountsPerMonth',
    //         'jalanCountsPerMonth',
    //         'lokasiParkirCountsPerMonth'
    //     ));
    // }
}
