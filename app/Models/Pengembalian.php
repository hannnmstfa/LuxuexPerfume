<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $fillable = [
        'transaksi_id',
        'deskripsi',
        'status',
        'video_unboxing',
        'foto_pendukung',   
        'catatan',
        'type'
    ];
    protected $casts = [
        'foto_pendukung' => 'array'
    ];
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}   
