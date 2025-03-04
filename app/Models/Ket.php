<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ket extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parker(){
        return $this->hasMany(Parker::class, 'id');
    }
}
