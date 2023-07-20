<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Rules\PasswordValidation;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/login';


    protected function rules()
    {
        return [
            'token' => 'required',
            'password' => ['required', 'confirmed', new PasswordValidation],
        ];
    }

    protected function reset(Request $request)
    {

        try {
            $request->validate($this->rules(), $this->validationErrorMessages());
        } catch (ValidationException $exception) {
            return redirect()->back()
                ->withErrors($exception->errors())
                ->withInput();
        }

        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)
            ->first();

        if (!$tokenData || !Carbon::parse($tokenData->created_at)->addMinutes(config('auth.passwords.users.expire'))->isFuture()) {
            return redirect()->back()->with('error', 'This password reset link is expired');
        }

        $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );
        return redirect()->route('login')->with('message', 'Password is reset successfully. Login to continue');
    }


    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));
        return redirect()->route('login')->with('message', 'Password is reset successfully. Login to continue');
    }
}
