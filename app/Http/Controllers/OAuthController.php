<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use RealRashid\SweetAlert\Facades\Alert;

class OAuthController extends Controller
{
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::whereEmail($googleUser->email)->first();
        if (!$user) {
            Alert::error('Gagal Login', 'Email tidak terdaftar, silahkan daftarkan akun anda terlebih dahulu.');
            return to_route('login');
        }
        $user->update([
            'google_id' => $googleUser->id,
        ]);
        if (!$user->email_verified_at) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }
        $session = session()->getId();
        Auth::login($user);
        Keranjang::updateKeranjang($session);
        return redirect()->intended('/');
    }
}
