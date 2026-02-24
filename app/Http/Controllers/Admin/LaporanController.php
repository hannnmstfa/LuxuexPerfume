<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }
    public function pdf($bulan)
    {
        $data = Transaksi::where('created_at', 'like', $bulan . '%')
            ->where('status_bayar', 'berhasil')
            ->orderBy('created_at', 'asc')
            ->get();
        $pdf = Pdf::loadView('admin.laporan.pdf', compact('data', 'bulan'))
            ->setPaper('a4');
        return $pdf->stream();
    }
}
