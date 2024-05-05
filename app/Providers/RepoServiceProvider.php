<?php

namespace App\Providers;

use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });
        // $this->app->bind(UserService::class, function (Application $app) {
        //     return new UserService($app->make(UserRepositoryInterface::class));
        // });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
