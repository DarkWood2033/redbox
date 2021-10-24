<?php

namespace Modules\Client\Services\Client;

use Illuminate\Support\Str;

class PhoneNumberAdapter
{
    public static function convert(string $phone_number): string
    {
        $matches = [];
        preg_match_all("/\d+/", $phone_number, $matches);
        $phone_number_formatted = implode('', $matches[0]);
        if(Str::startsWith($phone_number_formatted, '8')){
            $phone_number_formatted[0] = '7';
        }
        return $phone_number_formatted;
    }
}
