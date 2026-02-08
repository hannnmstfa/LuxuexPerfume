<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $fillable = [
        'transaksi_id',
        'resi',
        'ekspedisi',
        'last_phone',
        'status',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
    public function trackings_details(){
        return $this->hasMany(TrackingDetails::class, 'trackings_id')->orderBy('created_at', 'desc');
    }
}
