<?php

namespace App\Auth;

use App\Auth\Repositories\DoctrineUserRepository;
use App\Auth\Repositories\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerRepositories();
    }

    private function registerRepositories()
    {
        $this->app->when(DoctrineUserRepository::class)
            ->needs(EntityRepository::class)
            ->give(function (){
                return new EntityRepository(
                    $this->app->make(EntityManagerInterface::class),
                    new ClassMetadata(User::class)
                );
            });
        $this->app->singleton(UserRepository::class, DoctrineUserRepository::class);
    }
}
