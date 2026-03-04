<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function aktif()
    {
        $users = User::withSum('transaksi_sukses', 'total_harga')
            ->whereNull('deleted_at')
            ->orderBy('role', 'asc')
            ->orderByDesc('transaksi_sukses_sum_total_harga')
            ->get();
        return view('admin.users.aktif', compact('users'));
    }
    public function softDelete($id)
    {
        $user = User::findOrFail($id);
        $adminCheck = User::where('role', 'admin')->where('id', '!=', $user->id)->exists();
        if (!$adminCheck) {
            Alert::warning('Warning !!!', 'Harus ada minimal 1 role admin yang aktif');
            return back();
        }
        $user->delete();
        Alert::success('Berhasil', 'Akun pengguna berhasil dinonaktifkan');
        return back();
    }
    public function role($id)
    {
        $user = User::findOrFail($id);
        $adminCheck = User::where('role', 'admin')->where('id', '!=', $user->id)->exists();
        if (!$adminCheck) {
            Alert::warning('Warning !!!', 'Harus ada minimal 1 akun dengan role admin');
            return back();
        }
        if ($user->role == 'admin') {
            $user->role = 'customer';
        } else {
            $user->role = 'admin';
        }
        $user->save();
        Alert::success('Berhasil', 'Berhasil mengubah role pengguna');
        return back();
    }
    public function nonaktif(){
        $users = User::onlyTrashed()->orderBy('name', 'asc')->get();
        return view('admin.users.nonaktif', compact('users'));
    }
    public function restore($id){
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        Alert::success('Berhasil','Akun pengguna berhasil dipulihkan');
        return back();
    }
    public function forceDestroy($id){
        $user = User::onlyTrashed()->findOrFail($id);
        $email = $user->email;
        $user->forceDelete();
        Alert::success('Berhasil','Akun ' . $email .' berhasil dihapus secara permanen dari sistem');
        return back();
    }
}
