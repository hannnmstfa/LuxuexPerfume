<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AfterLoginController extends Controller
{
    public function checkout()
    {
        $cek = Keranjang::where('users_id', auth()->id())->exists();
        if (!$cek) {
            Alert::warning('Keranjang Kosong !!!', 'Silahkan menambahkan beberapa produk kedalam keranjang terlebih dahulu.');
            return to_route('produk');
        }
        return view('afterlogin.checkout');
    }
    public function checkoutPost(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string',
            'no_penerima' => ['required', 'string', 'regex:/^08[0-9]{8,11}/'],
            'kode_area' => 'required|string',
            'alamat' => 'required|string',
            'payment_method' => 'required|string',
        ], [
            'payment_method.required' => 'Silahkan Pilih metode pembayaran terlebih dahulu'
        ]);
        $data = Keranjang::where('users_id', auth()->id())->get();
        $subtotal = $data->sum(function ($item) {
            return ($item->produks->harga_diskon ? $item->produks->harga_diskon : $item->produks->harga) * $item->jumlah;
        });
        $trx = Transaksi::create([
            'users_id' => auth()->id(),
            'kodeTrx' => LP,
            'subtotal',
            'ongkir',
            'total_harga',
            'metode_bayar',
            'tripay_ref',
            'status_bayar',
        ]);
        dd($request->all(), $data, $subtotal);
    }
}
