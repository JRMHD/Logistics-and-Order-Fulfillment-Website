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
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return $this->redirectBasedOnRole($user, '?verified=1');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return $this->redirectBasedOnRole($user, '?verified=1');
    }

    /**
     * Redirect user based on their role after email verification
     */
    private function redirectBasedOnRole($user, $queryString = '')
    {
        // Redirect admins and managers to admin dashboard
        if (in_array($user->role, ['admin', 'manager'])) {
            return redirect()->intended('/admin/dashboard' . $queryString);
        }

        // Redirect regular users to user dashboard
        return redirect()->intended(route('dashboard', absolute: false) . $queryString);
    }
}
