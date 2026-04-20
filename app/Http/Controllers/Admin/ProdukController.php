<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebpController;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use RahulHaque\Filepond\Facades\Filepond;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::orderBy('stok', 'asc')->get();
        confirmDelete('Konfirmasi !!!', 'Apakah anda yakin ingin menghapus produk?');
        return view('admin.produk.index', compact('produks'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string',
            'nama' => 'required|string',
            'harga' => 'required|integer|min:1',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'required|string',
            'gambar' => ['required', Rule::filepond(['image'])],
        ], [
            'gambar.image' => 'Format gambar produk tidak sesuai',
            'harga.integer' => 'Format Penulisan tidak boleh mengandung karakter apapun. <b>Cth: 5000</b>',
            'harga.min' => 'Harga paling sedikit adalah <b>1</b>',
        ]);
        $nama_file = Str::slug($request->nama) . '-' . Str::random(10);
        $filepond = Filepond::field($request->gambar)->moveTo('produk/' . $nama_file);
        $pathGambar = '/storage/' . $filepond['location'];
        Produk::create([
            'slug' => Str::slug($request->nama),
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'path_foto' => $pathGambar,
        ]);
        Alert::success('Sukses', 'Produk berhasil ditambahkan');
        return back();
    }
    public function setDiskon(Request $request, $id)
    {
        $request->validate([
            'harga_diskon' => 'required|integer|min:1'
        ], [
            'harga_diskon.min' => 'Harga paling sedikit adalah <b>1</b>',
        ]);
        $data = Produk::findOrFail($id);
        $data->update([
            'harga_diskon' => $request->harga_diskon
        ]);
        Alert::success('Sukses', 'Berhasil mengatur harga diskon');
        return back();
    }
    public function delDiskon($id)
    {
        $data = Produk::findOrFail($id);
        $data->update([
            'harga_diskon' => null,
        ]);
        Alert::success('Sukses', 'Berhasil menghapus harga diskon');
        return back();
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required|string',
            'nama' => 'required|string',
            'harga' => 'required|integer|min:1',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'required|string',
            'gambar' => ['nullable', Rule::filepond(['image'])],
        ], [
            'gambar.image' => 'Format gambar produk tidak sesuaii',
            'harga.integer' => 'Format Penulisan tidak boleh mengandung karakter apapun. <b>Cth: 5000</b>',
            'harga.min' => 'Harga paling sedikit adalah <b>1</b>',
        ]);
        $data = Produk::findOrFail($id);
        if ($request->gambar) {
            if (file_exists(public_path($data->path_foto)) && is_file(public_path($data->path_foto))) {
                unlink(public_path($data->path_foto));
            }
            $nama_file = Str::slug($request->nama) . '-' . Str::random(10);
            $filepond = Filepond::field($request->gambar)->moveTo('produk/' . $nama_file);
            $pathGambar = '/storage/' . $filepond['location'];
            $data->path_foto = $pathGambar;
            $data->save();
        }
        $data->update([
            'slug' => Str::slug($request->nama),
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
        ]);
        Alert::success('Sukses', 'Berhasil mengupdate data produk');
        return back();
    }
    public function destroy($id)
    {
        $data = Produk::findOrFail($id);
        // if (file_exists(public_path($data->path_foto)) && is_file(public_path($data->path_foto))) {
        //     unlink(public_path($data->path_foto));
        // }
        $data->delete();
        Alert::success('Sukses', 'Berhasil menghapus parfum');
        return back();
    }
}
