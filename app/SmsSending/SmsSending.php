<?php

namespace App\SmsSending;

interface SmsSending
{
    public function send(string $phone_number, string $message): bool;
}
