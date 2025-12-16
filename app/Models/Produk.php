<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'nama',
        'harga',
        'harga_diskon',
        'kategori',
        'deskripsi',
        'path_foto',
    ];
    public function stocks(){
        return $this->hasOne(Stock::class, 'produks_id');
    }
}
