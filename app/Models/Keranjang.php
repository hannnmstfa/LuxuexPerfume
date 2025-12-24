<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $fillable = [
        'users_id',
        'sessions_id',
        'produks_id',
        'jumlah',
    ];
}
