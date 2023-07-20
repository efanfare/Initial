<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailWithDomainValidation implements Rule
{
    public function passes($attribute, $value)
    {
        // Use PHP's built-in filter_var function with FILTER_VALIDATE_EMAIL
        // to validate the email format
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        // Extract the domain from the email address
        $domain = explode('@', $value)[1];

        // Use checkdnsrr function to check if the domain has valid DNS records
        if (!checkdnsrr($domain, 'MX') && !checkdnsrr($domain, 'A')) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'The :attribute must be a valid email address with a valid domain.';
    }
}
