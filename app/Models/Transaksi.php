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
        'fee_payment',
        'tripay_ref',
        'status_bayar',
    ];
    public function transaksi_items(){
        return $this->hasMany(TransaksiItem::class, 'transaksi_id');
    }
}
