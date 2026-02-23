<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Tracking;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $trx = Transaksi::with(['transaksi_items'])
            ->where('status_bayar', 'berhasil')->get();
        $produkTerjual = $trx->flatMap->transaksi_items->sum('jumlah');
        $menungguProses = Tracking::where('status', 'sedang dikemas')->get();
        $stokHabis = Produk::where('stok', 0)->get();
        return view('admin.dashboard', compact('trx', 'produkTerjual', 'menungguProses', 'stokHabis'));
    }
}
