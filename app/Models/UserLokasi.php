<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLokasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'latitude',
        'longitude',
        'alamat'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jamLokasi(){
        return $this->belongsTo(JamLokasi::class, 'id_jamLokasi');
    }
}
