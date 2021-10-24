<?php

namespace App\Validation;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumberRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        return (bool)preg_match(
            '/^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/',
            $value
        );
    }

    public function message(): string
    {
        return 'Недействительный номер телефона';
    }
}
