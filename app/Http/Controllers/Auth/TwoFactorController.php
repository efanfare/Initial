<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckTwoFactorRequest;
use App\Notifications\TwoFactorCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class TwoFactorController extends Controller
{
    public function show(Request $request)
    {
        if ($request->user()->two_factor_code === null) {
            return redirect()->route('user.dashboard');
        }

        return view('auth.twoFactor');
    }

    public function check(CheckTwoFactorRequest $request)
    {
        $user = $request->user();

        $codes = $request->input('two_factor_code')['1'] . $request->input('two_factor_code')['2'] . $request->input('two_factor_code')['3'] . $request->input('two_factor_code')['4'];

        if ($codes == $user->two_factor_code) {
            $user->resetTwoFactorCode();

            return redirect()->route('user.dashboard');
        }

        return redirect()->back()->withErrors(['two_factor_code' => 'The verification code you have entered does not match.']);
    }

    public function resend(Request $request)
    {

        $request->user()->generateTwoFactorCode();

        $request->user()->notify(new TwoFactorCodeNotification());

        return response()->json([
            'message' => 'The verification code has been sent again',
        ], 200);
    }
}
