<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        $cek = User::where('email', $request->email)->exists();
        if (!$cek) {
            return back()->withInput()->withErrors(['email' => 'E-Mail tidak terdaftar']);
        } else {
            Password::sendResetLink(
                $request->only('email')
            );
            Alert::success('Success', 'Link reset password telah dikirim ke email anda');
            return back();
        }
    }
}
