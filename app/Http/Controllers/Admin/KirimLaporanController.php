<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekapParkir;
use Illuminate\Http\Request;

class KirimLaporanController extends Controller
{
    public function index(){

        $rekap = RekapParkir::all();

        return view('admin.kirim.index', compact('rekap'));
    }
}
