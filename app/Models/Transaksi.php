<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'users_id',
        'kodeTrx',
        'subtotal',
        'ongkir',
        'total_harga',
        'metode_bayar',
        'tripay_ref',
        'status_bayar',
    ];
}
