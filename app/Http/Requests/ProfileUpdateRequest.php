<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\PasswordValidation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules\Password;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $passwordRules = new Password(8);
        $passwordRules->mixedCase();
        $passwordRules->letters();
        $passwordRules->numbers();

        return [
            'first_name' => [
                'required',
                'string',
                'regex:/^[a-zA-Z]+$/',
            ],
            'last_name' => [
                'required',
                'string',
                'regex:/^[a-zA-Z]+$/',
            ],
            // 'country_id' => [
            //     'required',
            //     'integer',
            // ],
            'city' => [
                'required',
                'string',
                'regex:/^[a-zA-Z]+$/',
            ],
            'contact_number' => [
                'required',
                'max:15',
                'string',
                'regex:/^[+()0-9\s-]+$/',
            ],
            'password' => [
                'nullable',
                'string',
                'max:255',
                'confirmed',
                new PasswordValidation,
            ],
        ];
    }
    public function messages()
    {
        return [
            'contact_number.regex' => 'Contact number format is invalid.',
        ];
    }
}
