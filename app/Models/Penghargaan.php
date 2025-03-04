<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghargaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_lokasiParkir',
        'jenisKendaraan',
        'harga',
    ];

    public function lokasi()
    {
        return $this->belongsTo(JamLokasi::class, 'id_lokasiParkir');
    }

    // public function jalan()
    // {
    //     return $this->belongsTo(Jalan::class, 'id_jalan', 'id');
    // }
}
