<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $cek = User::where('email', $request->email)->exists();
        if (!$cek) {
            return back()->withInput()->withErrors(['email' => 'E-Mail tidak terdaftar']);
        } else {
            $request->validate(
                [
                    'token' => ['required'],
                    'email' => ['required', 'email'],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ],
                [
                    'email.required' => 'Email dibutuhkan',
                    'password.min' => 'Password minimal 8 karakter',
                    'password.confirmed' => 'Konfirmasi password tidak sama',
                ]
            );
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($request->password),
                        'remember_token' => Str::random(60),
                    ])->save();

                    event(new PasswordReset($user));
                }
            );
            if ($status == Password::INVALID_TOKEN) {
                return back()->withErrors(['token' => 'Token tidak valid atau sudah kadaluarsa. Silahkan request link reset baru.']);
            }
            Alert::success('Success', 'Password berhasil diubah. Silahkan login dengan password baru Anda.');
            return to_route('login');
        }
    }
}
