<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapParkir extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kolektor(){
        return $this->belongsTo(User::class, 'id_kolektor');
    }

    public function shift(){
        return $this->belongsTo(Shift::class, 'id_shift');
    }

    public function parker(){
        return $this->belongsTo(Parker::class, 'id');
    }

    public function jam(){
        return $this->belongsTo(JamLokasi::class, 'id_lokasiParkir', 'id');
    }

    // Hosting
    public function lokasi_parkir() {
        return $this->belongsTo(JamLokasi::class, 'id_lokasiParkir');
    }

    public function nama_lokasi() {
        return $this->belongsTo(Jalan::class, 'kodeJln', 'kodeJln');
    }
}
