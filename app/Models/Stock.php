<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'produks_id',
        'jumlah',
    ];
    public function produks(){
        return $this->belongsTo(Produk::class, 'produks_id');
    }
}
