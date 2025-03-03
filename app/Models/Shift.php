<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parker()
    {
        return $this->hasMany(Parker::class, 'id_shift');
    }

    public function user(){
        return $this->hasMany(User::class, 'id_shift');
    }

    public function setor(){
        return $this->hasMany(Setor::class, 'id_user');
    }

    public function rekap(){
        return $this->hasMany(RekapParkir::class, 'id_shift');
    }
}
