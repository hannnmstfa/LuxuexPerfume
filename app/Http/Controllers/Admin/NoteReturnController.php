<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EditorController;
use App\Models\Catatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class NoteReturnController extends Controller
{
    public function index(){
        $datas = Catatan::orderBy('nama', 'asc')->get();
        confirmDelete('Konfirmasi !!!', 'Apakah anda yakin ingin menghapus catatan ini?');
        return view('admin.pengembalian.template', compact('datas'));
    }
    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string|max:225',
            'konten' => 'required|string',
        ]);
        $konten = EditorController::convertImage($request->nama, $request->konten);
        Catatan::create([
            'nama' => $request->nama,
            'konten' => $konten,
        ]);
        Alert::success('Sukses', 'Berhasil menambahkan catatan pengembalian');
        return back();
    }
}
