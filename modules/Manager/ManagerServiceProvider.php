<?php

namespace Modules\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Illuminate\Support\ServiceProvider;
use Modules\Manager\Entities\Manager;
use Modules\Manager\Repositories\Manager\DoctrineManagerRepository;
use Modules\Manager\Repositories\Manager\ManagerRepository;

class ManagerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerRepositories();
        $this->loadRoutesFrom(__DIR__.'/UI/Http/routes.php');
        $this->loadViewsFrom(__DIR__.'/UI/Http/Views', 'manager');
    }

    private function registerRepositories()
    {
        $this->app->when(DoctrineManagerRepository::class)
            ->needs(EntityRepository::class)
            ->give(function (){
                return new EntityRepository(
                    $this->app->make(EntityManagerInterface::class),
                    new ClassMetadata(Manager::class)
                );
            });
        $this->app->singleton(ManagerRepository::class, DoctrineManagerRepository::class);
    }
}
