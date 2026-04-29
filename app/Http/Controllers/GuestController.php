<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
        $produk = Produk::where('slug', $slug)->first();
        if (!$produk) {
            abort(404, 'Produk tidak ditemukan');
        }
        return view('guest.produk.detail', compact('produk'));
    }
    public function produkKeranjang(Request $request, $slug)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);
        $produk = Produk::where('slug', $slug)->first();
        if (!$produk) {
            abort(404, 'Produk tidak ditemukan');
        }
        if (Auth::check()) {
            $cek = Keranjang::where('users_id', Auth::user()->id)
                ->where('produks_id', $produk->id)
                ->first();
            if ($cek) {
                $cek->increment('jumlah', $request->jumlah);
            } else {
                Keranjang::create([
                    'users_id' => Auth::user()->id,
                    'produks_id' => $produk->id,
                    'jumlah' => $request->jumlah,
                ]);
            }
        } else {
            $cek = Keranjang::where('sessions_id', session()->getId())
                ->where('produks_id', $produk->id)
                ->first();
            if ($cek) {
                $cek->increment('jumlah', $request->jumlah);
            } else {
                Keranjang::create([
                    'sessions_id' => session()->getId(),
                    'produks_id' => $produk->id,
                    'jumlah' => $request->jumlah,
                ]);
            }
        }
        Alert::success('Sukses', 'Berhasil menambahkan produk kedalam keranjang');
        return back();
    }
    public function keranjang()
    {
        session(['url.intended' => url()->current()]);
        return view('guest.keranjang');
    }
    public function ketentuanLayanan()
    {
        return view('guest.ketentuanLayanan');
    }
    public function kebijakanPrivasi()
    {
        return view('guest.kebijakanPrivasi');
    }
}
