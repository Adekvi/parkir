<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jalan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class, 'namaLokasi', 'kodeJln');
    }

    public function jam()
    {
        return $this->hasMany(Jalan::class, 'kodeJln', 'kodeJln');
    }

    public function parkir()
    {
        return $this->hasMany(Parker::class, 'kodeJln', 'kodeJln');
    }

    public function lokasiParkir()
    {
        return $this->belongsTo(JamLokasi::class, 'id_lokasiParkir', 'id');
    }

    public function lokasi_parkir()
    {
        return $this->hasMany(JamLokasi::class, 'kodeJln', 'kodeJln');
    }

    public function pelangan()
    {
        return $this->hasMany(DataPelanggan::class, 'id');
    }

    // public function harga()
    // {
    //     return $this->hasMany(Penghargaan::class, 'id');
    // }
}
