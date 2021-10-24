<?php

namespace App\QrCode;

use Illuminate\Support\ServiceProvider;

class QrCodeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(QrCode::class, GoqrQrCode::class);
    }
}
