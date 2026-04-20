<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EditorController;
use App\Models\Pengembalian;
use App\Mail\Pengembalian as MailReturn;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
            abort(404, 'Data Pengembalian tidak ditemukan');
        }
        return view('admin.pengembalian.detail', compact('data'));
    }
    public function update($return_code, Request $request)
    {
        $request->validate([
            'status' => 'required|string',
            'konten' => 'required|string',
        ]);
        $data = Pengembalian::where('return_code', $return_code)->first();
        if (!$data) {
            abort(404, 'Data Pengembalian tidak ditemukan');
        }
        $catatan = EditorController::convertImage($return_code, $request->konten);
        $data->catatan = $catatan;
        if ($request->status == 'disetujui') {
            $data->status = 'disetujui';
        } else {
            $data->status = 'ditolak';
        }
        $data->save();
        Alert::success('Sukses', 'Berhasil memproses pengajuan');
        return back();
    }
}
