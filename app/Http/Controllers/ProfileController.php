<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('afterlogin.profile.edit', [
            'user' => $request->user(),
        ]);
    }
    public function index()
    {
        $user = User::where('id', Auth::id())->first();
        return view('afterlogin.profile.index', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:225',
            'email' => ['nullable', 'email', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone' => ['required', 'string', 'regex:/^08[0-9]{8,11}$/', Rule::unique('users')->ignore(Auth::user()->id)],
            'alamat' => 'required|string'
        ], [
            'email.unique' => 'Email sudah terdaftar sebagai pengguna lain',
            'phone.regex' => 'No Telepon harus diawali <b>08xxxxxxxxx</b>',
            'phone.unique' => 'No Telepon sudah terdaftar'
        ]);
        $request->user()->fill([
            'name' => $request->name,
            'email' => $request->email ?? Auth::user()->email,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
        ]);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        toast('Profil berhasil diperbarui', 'success')->width('max-content');
        return to_route('profile.index');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ], [
            'password.current_password' => 'Kata sandi saat ini yang anda masukkan salah',
        ]);

        $user = $request->user();
        $trx = Transaksi::where('users_id', $user->id)->exists();

        Auth::logout();
        if ($trx) {
            $user->delete();
        } else {
            $user->forceDelete();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
