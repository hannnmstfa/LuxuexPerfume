<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index()
    {
        return view('admin.produk.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string',
            'nama' => 'required|string',
            'harga' => 'required|int',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image',
        ], [
            'gambar.image' => 'Gambar parfum harus bertipe image'
        ]);
        dd($request->all());
        Produk::create([
            'slug' => Str::slug($request->nama),
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kategori',
            'deskripsi'
        ]);
    }
}
