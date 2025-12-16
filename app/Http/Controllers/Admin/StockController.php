<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StockController extends Controller
{
    public function index(){
        $data = Stock::with('produks')->get();
        return view('admin.stock.index', compact('data'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'jumlah' => 'required|integer|min:0'
        ], [
            'jumlah.integer' => 'Format Penulisan tidak boleh mengandung karakter apapun. <b>Cth: 50</b>',
            'jumlah.min' => 'Jumlah paling sedikit adalah <b>0</b>',
        ]);
        $data = Stock::findOrFail($id);
        $data->update([
            'jumlah' => $request->jumlah,
        ]);
        Alert::success('Sukses', 'Berhasil memperbarui data stok');
        return back();
    }
}
