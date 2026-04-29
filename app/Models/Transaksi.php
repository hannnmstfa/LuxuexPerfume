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
        'is_success',
        'pay_at',
    ];
    protected function casts()
    {
        return [
            'pay_at' => 'datetime'
        ];
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function transaksi_items()
    {
        return $this->hasMany(TransaksiItem::class, 'transaksi_id');
    }
    public function transaksi_details()
    {
        return $this->hasOne(TransaksiDetail::class, 'transaksi_id');
    }
    public function trackings()
    {
        return $this->hasOne(Tracking::class, 'transaksi_id')->where('is_return', false);
    }
    public function tracking_return()
    {
        return $this->hasOne(Tracking::class, 'transaksi_id')->where('is_return', true);
    }
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'transaksi_id');
    }
    public function tracking_sukses()
    {
        return $this->hasOne(Tracking::class, 'transaksi_id')->where('is_return', false)->where('status', 'pengiriman selesai');
    }
}