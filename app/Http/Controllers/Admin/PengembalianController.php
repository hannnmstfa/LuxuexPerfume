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
        $datas = Pengembalian::orderByDesc('status')->oldest()->get();
        return view('admin.pengembalian.index', compact('datas'));
    }
    public function show($return_code)
    {
        $data = Pengembalian::with('transaksi')->where('return_code', $return_code)->first();
        if (!$data) {
            abort(404, 'Data tidak ditemukan');
        }
        return view('admin.pengembalian.detail', compact('data'));
    }
}
