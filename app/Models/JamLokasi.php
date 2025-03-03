<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamLokasi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->hasMany(User::class, 'id_lokasiParkir', 'id');
    }

    // public function user(){
    //     return $this->hasMany(User::class, 'id_jamLokasi');
    // }

    public function userLokasi(){
        return $this->hasMany(UserLokasi::class, 'id_userLokasi');
    }

    public function harga(){
        return $this->hasMany(Penghargaan::class, 'id_lokasiParkir');
    }

    public function jalan(){
        return $this->belongsTo(Jalan::class, 'kodeJln', 'kodeJln');
    }
    
    // Model JamLokas


    public function rekap(){
        return $this->hasMany(RekapParkir::class, 'id_lokasiParkir', 'id');
    }

    // public function userLokasi(){
    //     return $this->hasMany(UserLokasi::class, 'id_userLokasi');
    // }

    // public function harga(){
    //     return $this->hasMany(Penghargaan::class, 'id_lokasiParkir');
    // }

    // Model JamLokasi
    public function parker(){
        return $this->hasMany(Parker::class, 'id_lokasiParkir', 'id');
    }
}
