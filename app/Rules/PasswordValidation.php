<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordValidation implements Rule
{
    public function passes($attribute, $value)
    {

        $passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$!%*?&])[^\']*[a-zA-Z\d@#$!%*?&]{8,}$/';
        return preg_match($passwordRegex, $value);
    }

    public function message()
    {
        return 'The :attribute must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one digit, and one of the following symbols: @ # $ ! % * ? &';
    }
}
