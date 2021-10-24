<?php

namespace App\QrCode;

interface QrCode
{
    public function generateUrl(string $data): string;
}
