<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_shift',
        'id_lokasiParkir',
        // 'namaLokasi',
        'namaLengkap',
        'username',
        'email',
        'password',
        'role',
        'alamat',
        'jekel',
        'tglLahir',
        'tempatLahir',
        'namaLokasi',
        'fotoKtp',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function parker(){
        return $this->hasMany(Parker::class, 'id_user', 'id');
    }

    public function userLokasi(){
        return $this->hasOne(UserLokasi::class, 'id_user');
    }

    public function shift(){
        return $this->belongsTo(Shift::class, 'id_shift');
    }

    public function jalan(){
        return $this->belongsTo(Jalan::class, 'id_jalan', 'id');
    }

    public function rekap(){
        return $this->hasMany(RekapParkir::class);
    }

    public function jam(){
        return $this->belongsTo(JamLokasi::class, 'id_lokasiParkir', 'id');
    }

    // hosting
    public function lokasi_parkir() {
        return $this->belongsTo(JamLokasi::class, 'id_lokasiParkir');
    }

    public function penghargaan() {
        return $this->hasMany(Penghargaan::class, 'id_lokasiParkir', 'id_lokasiParkir');
    }

    public function nama_lokasi() {
        return $this->belongsTo(Jalan::class, 'namaLokasi', 'kodeJln');
    }
}
