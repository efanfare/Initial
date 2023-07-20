<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

/*
  |--------------------------------------------------------------------------
  | SocialLoginController
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for social login and registered.
  |
 */

class SocialLoginController extends Controller
{


    /**
     * @param $provider
     * @return JsonResponse
     */
    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param $provider
     * @return JsonResponse
     */
    public function handleProviderCallback($driver)
    {

        // dd(Socialite::driver($driver)->user());
        try {
            $user = Socialite::driver($driver)->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }

        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            [$firstName, $lastName] = User::getFirstAndLastName($user->getName());
            $newUser                    = new User;
            $newUser->provider_name     = $driver;
            $newUser->provider_id       = $user->getId();
            $newUser->name              = $user->getName();
            $newUser->first_name        = $firstName;
            $newUser->last_name         = $lastName;
            $newUser->email             = $user->getEmail();
            $newUser->two_factor        = 0;
            $newUser->email_verified_at = now();
            $newUser->package_id        = Package::BASIC;
            $newUser->package_interval =  Package::MONTHLY;
            $newUser->save();
            $newUser->addMediaFromUrl($user->getAvatar())->toMediaCollection('profile_image');
            auth()->login($newUser, true);
        }

        return redirect(route('user.dashboard'));
    }
}
