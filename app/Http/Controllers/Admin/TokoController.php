<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TokoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use RahulHaque\Filepond\Facades\Filepond;
use RealRashid\SweetAlert\Facades\Alert;

class TokoController extends Controller
{
    public function index()
    {
        $toko = TokoSetting::first();
        return view('admin.toko.index', compact('toko'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'logo' => ['nullable', Rule::filepond(['image'])],
            'nama_toko' => ['required', 'string', 'max:225'],
            'email_toko' => ['required', 'email'],
            'phone_toko' => ['required', 'string', 'regex:/^08[0-9]{8,11}$/'],
            'kode_area' => ['required', 'string'],
            'alamat_toko' => ['required', 'string'],
        ], [
            'phone_toko.regex' => 'No Telepon harus diawali <b>08xxxxxxxxx</b>',
        ]);
        
        $toko = TokoSetting::first();
        if ($toko) {
            $toko->update([
                'nama_toko' => $request->nama_toko ?? $toko->nama_toko,
                'email_toko' => $request->email_toko ?? $toko->email_toko,
                'phone_toko' => $request->phone_toko ?? $toko->phone_toko,
                'kode_area' => $request->kode_area ?? $toko->kode_area,
                'alamat_toko' => $request->alamat_toko ?? $toko->alamat_toko,
            ]);
        }else{
            $toko = TokoSetting::create([
                'nama_toko' => $request->nama_toko,
                'email_toko' => $request->email_toko,
                'phone_toko' => $request->phone_toko,
                'kode_area' => $request->kode_area,
                'alamat_toko' => $request->alamat_toko,
            ]);
        }
        if($request->logo){
            if(file_exists(public_path($toko->path_logo)) && is_file(public_path($toko->path_logo))){
                unlink(public_path($toko->path_logo));
            }
            $namaLogo = Str::slug($request->nama_toko) . '-' . now()->isoFormat('YMMDDHHmmss');
            $filepond = Filepond::field($request->logo)->moveTo('logo/' . $namaLogo);
            $toko->path_logo = '/storage/' . $filepond['location'] ?? null;
            $toko->save();
        }
        Alert::success('Sukses','Berhasil menyimpan update informasi');
        return back();  
    }
}