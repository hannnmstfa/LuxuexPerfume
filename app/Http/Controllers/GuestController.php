<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function home()
    {
        return view('guest.home');
    }
    public function produk()
    {
        return view('guest.produk.index');
    }
    public function detailProduk($slug)
    {
        $produk = Produk::with('stocks')->where('slug', $slug)->firstOrFail();
        return view('guest.produk.detail', compact('produk'));
    }
    public function keranjang()
    {
        return view('guest.keranjang');
    }
}
