<?php

namespace App\SmsSending;

use Illuminate\Support\ServiceProvider;

class SmsSendingServiceProvider extends ServiceProvider
{
    public function register()
    {
        if($this->app->environment(['prod', 'production'])){
            $this->app->singleton(SmsSending::class, SmscSmsSending::class);
        }else{
            $this->app->singleton(SmsSending::class, NullSmsSending::class);
        }
    }
}
