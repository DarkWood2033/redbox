<?php

namespace Modules\Administrator;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Modules\Administrator\Entities\Administrator;
use Modules\Administrator\Repositories\Administrator\AdministratorRepository;
use Modules\Administrator\Repositories\Administrator\DoctrineAdministratorRepository;
use Modules\Administrator\UI\Console\CreateAdminCommand;

class AdministratorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerRepositories();
        $this->loadRoutesFrom(__DIR__.'/UI/Http/routes.php');
        $this->loadViewsFrom(__DIR__.'/UI/Http/Views', 'administrator');
    }

    private function registerRepositories()
    {
        $this->app->when(DoctrineAdministratorRepository::class)
            ->needs(EntityRepository::class)
            ->give(function (){
                return new EntityRepository(
                    $this->app->make(EntityManagerInterface::class),
                    new ClassMetadata(Administrator::class)
                );
            });
        $this->app->singleton(AdministratorRepository::class, DoctrineAdministratorRepository::class);
    }
}
