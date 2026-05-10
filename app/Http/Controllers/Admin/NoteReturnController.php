<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EditorController;
use App\Models\Catatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class NoteReturnController extends Controller
{
    public function index()
    {
        $datas = Catatan::orderBy('nama', 'asc')->get();
        confirmDelete('Konfirmasi !!!', 'Apakah anda yakin ingin menghapus catatan ini?');
        return view('admin.pengembalian.template', compact('datas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:225',
            'konten' => 'required|string',
        ]);
        $konten = EditorController::convertImage($request->nama, $request->konten);
        if(empty(strip_tags($konten))){
            return back()->withInput()->withErrors('Konten tidak boleh kosong');
        }
        Catatan::create([
            'nama' => $request->nama,
            'konten' => $konten,
        ]);
        Alert::success('Sukses', 'Berhasil menambahkan catatan pengembalian');
        return back();
    }
    public function destroy($id)
    {
        $data = Catatan::find($id);
        if (!$data) {
            abort(404, 'Data tidak ditemukan');
        }
        EditorController::deleteImage($data->konten);
        $data->delete();
        Alert::success('Sukses', 'Berhasil menghapus template catatan');
        return back();
    }
    public function update(Request $request, $id){
        $request->validate([
            'namaEdit' => 'required|string|max:225',
            'kontenEdit' => 'required|string',
        ]);
        $data = Catatan::find($id);
        if(!$data){
            abort(404, 'Data tidak ditemukan');
        }
        $konten = EditorController::convertImage($request->namaEdit, $request->kontenEdit);
        if(empty(strip_tags($konten))){
            return back()->withInput()->withErrors('Konten tidak boleh kosong');
        }
        EditorController::filterImage($data->konten, $konten);
        $data->update([
            'nama' => $request->namaEdit,
            'konten' => $konten,
        ]);
        Alert::success('Sukses', 'Berhasil memperbarui catatan');
        return back();
    }
}
