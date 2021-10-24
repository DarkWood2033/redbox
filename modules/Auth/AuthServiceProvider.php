<?php

namespace Modules\Auth;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Illuminate\Support\ServiceProvider;
use Modules\Auth\Entities\ResetPassword;
use Modules\Auth\Repositories\ResetPassword\DoctrineResetPasswordRepository;
use Modules\Auth\Repositories\ResetPassword\ResetPasswordRepository;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerRepositories();
        $this->loadRoutesFrom(__DIR__.'/UI/Http/routes.php');
        $this->loadViewsFrom(__DIR__ . '/UI/Http/Views', 'auth');
    }

    private function registerRepositories()
    {
        $this->app->when(DoctrineResetPasswordRepository::class)
            ->needs(EntityRepository::class)
            ->give(function (){
                return new EntityRepository(
                    $this->app->make(EntityManagerInterface::class),
                    new ClassMetadata(ResetPassword::class)
                );
            });
        $this->app->singleton(ResetPasswordRepository::class, DoctrineResetPasswordRepository::class);
    }
}
