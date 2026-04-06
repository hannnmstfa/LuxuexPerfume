<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use App\Mail\Pengembalian as MailReturn;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $datas = Pengembalian::orderBy('status', 'desc')->get();
        return view('admin.pengembalian.index', compact('datas'));
    }
    public function show($kodeTrx)
    {
        $trx = Transaksi::where('kodeTrx', $kodeTrx)->first();
        if (!$trx) {
            abort(404, 'Transaksi tidak ditemukan');
        }
        $data = Pengembalian::with('transaksi')->where('transaksi_id', $trx->id)->first();
        return view('admin.pengembalian.detail', compact('data'));
    }
}
