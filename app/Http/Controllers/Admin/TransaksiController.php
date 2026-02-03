<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index(){
        $datas = Transaksi::with('users')
        ->with('trackings')
        ->orderByDesc('created_at')->get();
        return view('admin.transaksi.index', compact('datas'));
    }
    public function show($kodeTrx){
        $trx = Transaksi::with(['transaksi_items', 'transaksi_details', 'trackings', 'users'])
        ->where('kodeTrx', $kodeTrx)->first();
        return view('admin.transaksi.detail', compact('trx'));
    }
}
