<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Rules\EmailWithDomainValidation;
use App\Rules\PasswordValidation;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo()
    {
        if (auth()->user()->role_id == 1) {
            return '/admin';
        }
        return '/dashbord';
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', new EmailWithDomainValidation, 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', new PasswordValidation],
        ]);
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);
        return redirect()->route('user.dashboard');
    }


    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        [$firstName, $lastName] = User::getFirstAndLastName($data['name']);
        $user =  User::create([
            'name'     => $data['name'],
            'first_name'     => $firstName,
            'last_name'     => $lastName,
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'package_id' => Package::BASIC, // Default Plan
            'package_interval' => Package::MONTHLY,  // Default Plan Interval
        ]);
        $user->roles()->sync(2);


        return $user;
    }
}
