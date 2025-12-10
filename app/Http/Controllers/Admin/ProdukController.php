<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebpController;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::inRandomOrder()->get();
        confirmDelete('Konfirmasi !!!', 'Apakah anda yakin ingin menghapus parfum?');
        return view('admin.produk.index', compact('produks'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string',
            'nama' => 'required|string',
            'harga' => 'required|integer',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image',
        ], [
            'gambar.image' => 'Gambar parfum tidak sesuai'  
        ]);
        $pathFile = WebpController::convert($request->gambar, '/produk/', $request->nama);
        Produk::create([
            'slug' => Str::slug($request->nama),
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'path_foto' => $pathFile,
        ]);
        Alert::success('Sukses', 'Parfum berhasil ditambahkan');
        return back();
    }
    public function setDiskon(Request $request, $id){
        $request->validate([
            'harga_diskon' => 'required|integer'
        ]);
        $data = Produk::findOrFail($id);
        $data->update([
            'harga_diskon' => $request->harga_diskon
        ]);
        Alert::success('Sukses', 'Berhasil mengatur harga diskon');
        return back();
    }
    public function delDiskon($id){
        $data = Produk::findOrFail($id);
        $data->update([
            'harga_diskon' => null,
        ]);
        Alert::success('Sukses', 'Berhasil menghapus harga diskon');
        return back();
    }
    public function update(Request $request, $id){
        $request->validate([
            'kategori' => 'required|string',
            'nama' => 'required|string',
            'harga' => 'required|integer',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image',
        ], [
            'gambar.image' => 'Gambar parfum tidak sesuai'  
        ]);
        $data = Produk::findOrFail($id);
        if($request->hasFile('gambar')){
            if(file_exists(public_path($data->path_foto)) && is_file(public_path($data->path_foto))){
                unlink(public_path($data->path_foto));
            }
            $pathFile = WebpController::convert($request->gambar, '/produk/', $request->nama);
            $data->path_foto = $pathFile;
            $data->save();
        }
        $data->update([
            'slug' => Str::slug($request->nama),
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
        ]);
        Alert::success('Sukses', 'Berhasil mengupdate data parfum');
        return back();
    }
}
