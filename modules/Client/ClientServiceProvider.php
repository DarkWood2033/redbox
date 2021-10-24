<?php

namespace Modules\Client;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Illuminate\Support\ServiceProvider;
use Modules\Client\Entities\Client;
use Modules\Client\Entities\Visit;
use Modules\Client\Repositories\Client\ClientRepository;
use Modules\Client\Repositories\Client\DoctrineClientRepository;
use Modules\Client\Repositories\Discount\ArrayDiscountRepository;
use Modules\Client\Repositories\Discount\DiscountRepository;
use Modules\Client\Repositories\Visit\DoctrineVisitRepository;
use Modules\Client\Repositories\Visit\VisitRepository;

class ClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerRepositories();
        $this->loadRoutesFrom(__DIR__.'/UI/Http/routes.php');
        $this->loadViewsFrom(__DIR__.'/UI/Http/Views', 'client');
    }

    private function registerRepositories()
    {
        $this->app->when(DoctrineClientRepository::class)
            ->needs(EntityRepository::class)
            ->give(function (){
                return new EntityRepository(
                    $this->app->make(EntityManagerInterface::class),
                    new ClassMetadata(Client::class)
                );
            });
        $this->app->singleton(ClientRepository::class, DoctrineClientRepository::class);

        $this->app->when(DoctrineVisitRepository::class)
            ->needs(EntityRepository::class)
            ->give(function (){
                return new EntityRepository(
                    $this->app->make(EntityManagerInterface::class),
                    new ClassMetadata(Visit::class)
                );
            });
        $this->app->singleton(VisitRepository::class, DoctrineVisitRepository::class);

        $this->app->singleton(DiscountRepository::class, ArrayDiscountRepository::class);
    }
}
