<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parker extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function shift(){
        return $this->belongsTo(Shift::class, 'id_shift');
    }

    public function rekap(){
        return $this->hasMany(RekapParkir::class, 'id');
    }

    public function ket(){
        return $this->belongsTo(Ket::class, 'id');
    }

    // Model Parker
    public function jam(){
        return $this->belongsTo(JamLokasi::class, 'id_lokasiParkir');
    }

    // Hsoting
    public function lokasi_parkir(){
        return $this->belongsTo(JamLokasi::class, 'id_lokasiParkir', 'id');
    }

    public function jalan(){
        return $this->belongsTo(Jalan::class, 'namaJalan', 'kodeJln');
    }
    // public function exists_in_database_logic()
    // {
    //     // Contoh logika untuk memeriksa apakah data sudah ada di database
    //     return $this->status === 'Sudah disetor';
    // }

}
