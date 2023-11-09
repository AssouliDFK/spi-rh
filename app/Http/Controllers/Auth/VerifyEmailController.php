<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\HistoryController;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified and update user status.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));

            // Update the user's status here
            $user = $request->user();
            $user->status = 'active'; // Update the status as needed
            HistoryController::validateInvitationHistory($user->email, "active");

            $user->save();
        }

        return redirect()->intended(RouteServiceProvider::PROFILE.'?verified=1');

    }
}
