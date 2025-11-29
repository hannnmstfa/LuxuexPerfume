<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::updateOrCreate([
            'email' => $googleUser->email
        ], [
            'google_id' => $googleUser->id,
            'name' => $googleUser->name,
        ]);
        if(!$user->email_verified_at){
            $user->markEmailAsVerified();
            event(new Verified($user));
        }
        Auth::login($user);
        return redirect()->intended('/');
    }
}
