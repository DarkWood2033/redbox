<?php

namespace Modules\Main;

use Illuminate\Support\ServiceProvider;

class MainServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/UI/Http/routes.php');
        $this->loadViewsFrom(__DIR__.'/UI/Http/Views', 'main');
    }
}
