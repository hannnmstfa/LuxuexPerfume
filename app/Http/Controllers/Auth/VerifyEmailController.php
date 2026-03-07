<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        dd([
            'fullUrl' => $request->fullUrl(),
            'url' => $request->url(),
            'host' => $request->getHost(),
            'scheme' => $request->getScheme(),
            'query' => $request->query(),
            'hasValidSignature' => $request->hasValidSignature(),
            'app_url' => config('app.url'),
        ]);
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('/', absolute: false) . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('/', absolute: false) . '?verified=1');
    }
}
