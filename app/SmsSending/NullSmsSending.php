<?php

namespace App\SmsSending;

class NullSmsSending implements SmsSending
{
    public function send(string $phone_number, string $message): bool
    {
        return true;
    }
}
