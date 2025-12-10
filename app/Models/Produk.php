<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'slug',
        'nama',
        'harga',
        'harga_diskon',
        'kategori',
        'deskripsi',
        'path_foto',
    ];
}
