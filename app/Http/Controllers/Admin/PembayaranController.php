<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parker;
use App\Models\RekapParkir;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{

    public function index(){

        $rekap = RekapParkir::with('user')->get();
        $parker = Parker::with('user')->get();
        
        // dd($parker);

        return view('admin.bayar.index', compact('rekap', 'parker'));
    }

    // public function index(Request $request)
    // {
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');

    //     // Query untuk filter berdasarkan tanggal
    //     if ($startDate && $endDate) {
    //         $bayar = Parker::where('status', 'Sudah disetor')
    //             ->orWhere('status', 'Belum disetor')
    //             ->whereDate('created_at', '>=', $startDate)
    //             ->whereDate('created_at', '<=', $endDate)
    //             ->orderBy('id', 'asc')
    //             ->get();
    //     } else {
    //         $bayar = Parker::where('status', 'Sudah disetor')
    //             ->orWhere('status', 'Belum disetor')
    //             ->orderBy('id', 'asc')
    //             ->get();
    //     }

    //     // $rekap = RekapParkir::whereHas('user', function ($query) {
    //     //     $query->where('role', 'kolektor');
    //     // })->with('user')->get();  
    //     $rekap = RekapParkir::with('user', 'shift.parker')->get();      

    //     dd($rekap);

    //     // Cek jika data kosong
    //     $noDataMessage = $bayar->isEmpty() ? 'Tidak ada data untuk tanggal yang dipilih.' : '';

    //     return view('admin.bayar.index', compact('bayar', 'startDate', 'endDate', 'noDataMessage', 'rekap'));
    // }

}
