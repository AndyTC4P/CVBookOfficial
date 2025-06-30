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
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended($this->redirectPath($request));
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended($this->redirectPath($request));
    }

    /**
     * Define la ruta de redirección luego de verificar el email.
     */
    protected function redirectPath(EmailVerificationRequest $request): string
    {
        $user = $request->user();

        if ($user->isEmpresa() && $user->status === 'pendiente') {
            return route('empresa.esperando');
        }

        return route('dashboard') . '?verified=1';
    }
}

