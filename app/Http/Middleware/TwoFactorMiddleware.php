<?php

namespace App\Http\Middleware;

use App\Notifications\TwoFactorCodeNotification;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class TwoFactorMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->two_factor) {

            $user->generateTwoFactorCode();
            $user->notify(new TwoFactorCodeNotification());

            // auth()->logout();
            return redirect()->route('twoFactor.show');
        }

        return $next($request);
    }
}
