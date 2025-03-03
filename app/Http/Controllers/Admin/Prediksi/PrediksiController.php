<?php

namespace App\Http\Controllers\Admin\Prediksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrediksiController extends Controller
{
    public function index()
    {
        return view('admin.prediksi.index');
    }
}
