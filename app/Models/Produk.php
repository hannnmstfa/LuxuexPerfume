<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Produk extends Model
{
    use HasFactory, Searchable, SoftDeletes;
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
    public function toSearchableArray()
    {
        return [
            'nama' => $this->nama,
        ];
    }
}
