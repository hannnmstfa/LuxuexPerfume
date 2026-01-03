<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $fillable = [
        'transaksi_id',
        'nama_penerima',
        'no_penerima',
        'kode_area',
        'alamat_penerima',
    ];
}
