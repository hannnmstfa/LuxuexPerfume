<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    protected $fillable = [
        'transaksi_id',
        'produks_id',
        'harga',
        'jumlah',
        'subtotal',
    ];
    protected function casts(): array
    {
        return [
            'jumlah' => 'integer',
        ];
    }
    public function produks()
    {
        return $this->belongsTo(Produk::class, 'produks_id')->withTrashed();
    }
}
