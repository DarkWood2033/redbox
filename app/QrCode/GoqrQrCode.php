<?php

namespace App\QrCode;

class GoqrQrCode implements QrCode
{
    public function generateUrl(string $data): string
    {
        return "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=$data";
    }
}
