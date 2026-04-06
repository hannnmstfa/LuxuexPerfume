<?php

namespace App\Http\Controllers;

use App\Models\BuktiPengembalian;
use App\Models\Pengembalian;
use App\Models\TokoSetting;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use RahulHaque\Filepond\Facades\Filepond;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\Pengembalian as MailReturn;

class PengembalianController extends Controller
{
    public function index($kodeTrx)
    {
        $trx = Transaksi::with('tracking_sukses')
            ->where("kodeTrx", $kodeTrx)
            ->where('users_id', Auth::user()->id)
            ->where('status_bayar', 'berhasil')->first();
        if (!$trx) {
            abort(404, 'Transaksi tidak ditemukan');
        }
        if (!$trx->tracking_sukses) {
            abort(404, 'Transaksi tidak memenuhi syarat pengembalian');
        }
        $data = Pengembalian::with(['transaksi'])
            ->where("transaksi_id", $trx->id)->first();
        if ($data) {
            confirmDelete('Konfirmasi !!!', 'Apakah anda yakin ingin membatalkan pengajuan ini?');
            return view("afterlogin.pengembalian.index", compact("data"));
        } else {
            return to_route('pengembalian.create', $trx->kodeTrx);
        }
    }
    public function create($kodeTrx)
    {
        $trx = Transaksi::with(['tracking_sukses', 'pengembalian'])
            ->where("kodeTrx", $kodeTrx)
            ->where('users_id', Auth::user()->id)
            ->where('status_bayar', 'berhasil')->first();
        if (!$trx) {
            abort(404, 'Transaksi tidak ditemukan');
        }
        if (!$trx->tracking_sukses) {
            abort(404, 'Transaksi tidak memenuhi syarat pengembalian');
        }
        if ($trx->pengembalian) {
            Alert::warning('Warning !!!', 'Pengajuan sudah ada. Tidak dapat membuat pengajuan baru.');
            return to_route('pengembalian.index', $trx->kodeTrx);
        }
        return view('afterlogin.pengembalian.create', compact('trx'));
    }
    public function store(Request $request, $kodeTrx)
    {
        $request->validate([
            'tipe' => 'required|string',
            'deskripsi' => 'required|string',
            'unboxing' => ['required', Rule::filepond(['mimetypes:video/*'])],
            'pendukung.*' => ['nullable', Rule::filepond(['image'])],
        ], [
            'tipe.required' => 'Tipe pengembalian harus dipilih',
            'unboxing.mimetypes' => 'Format video tidak didukung',
            'pendukung.image' => 'Format foto tidak didukung',
        ]);
        $trx = Transaksi::with('tracking_sukses')
            ->where("kodeTrx", $kodeTrx)
            ->where('users_id', Auth::user()->id)
            ->where('status_bayar', 'berhasil')->first();
        if (!$trx) {
            abort(404, 'Transaksi tidak ditemukan');
        }
        if (!$trx->tracking_sukses) {
            abort(404, 'Transaksi tidak memenuhi syarat pengembalian');
        }
        $unboxing = Filepond::field($request->unboxing)->moveTo('pengajuan/unboxing-' . Str::random(20));
        $pengembalian = Pengembalian::create([
            'transaksi_id' => $trx->id,
            'deskripsi' => $request->deskripsi,
            'video_unboxing' => '/storage/' . $unboxing['location'],
            'type' => $request->tipe,
        ]);
        if ($request->pendukung[0]) {
            $pendukungs = Filepond::field($request->pendukung)->moveTo('pengajuan/pendukung-' . Str::random(20));
            $foto_pendukung = [];
            foreach ($pendukungs as $pendukung) {
                $foto_pendukung[] = '/storage/' . $pendukung['location'];
            }
            $pengembalian->foto_pendukung = $foto_pendukung;
            $pengembalian->save();
        }
        $toko = TokoSetting::data();
        if ($toko && $toko->email_toko) {
            Mail::to($toko->email_toko)->queue(new MailReturn($pengembalian));
        }
        Alert::success('Berhasil', 'Pengajuan pengembalian berhasil dibuat. Silahkan tunggu konfirmasi dari penjual');
        return to_route('pengembalian.index', $kodeTrx);
    }
    public function destroy($kodeTrx, $id)
    {
        $data = Transaksi::where('kodeTrx', $kodeTrx)
            ->where('users_id', Auth::user()->id)->first();
        if (!$data) {
            abort(404, 'Transaksi tidak ditemukan');
        }
        $data = Pengembalian::where('transaksi_id', $data->id)->first();
        if (!$data) {
            abort(404, 'Pengembalian tidak ditemukan');
        }
        if (file_exists(public_path($data->video_unboxing)) && is_file(public_path($data->video_unboxing))) {
            unlink(public_path($data->video_unboxing));
        }
        if ($data->foto_pendukung) {
            foreach ($data->foto_pendukung as $item) {
                if (file_exists(public_path($item)) && is_file(public_path($item))) {
                    unlink(public_path($item));
                }
            }
        }
        $data->delete();
        Alert::success('Sukses', 'Berhasil membatalkan pengajuan pengembalian');
        return to_route('trx.show', $kodeTrx);
    }
}
