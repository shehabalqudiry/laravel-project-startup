<?php

namespace App\Providers;

use Hexadog\MenusManager\Facades\Menus;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->share('menu', Menus::register('main'));
        // JsonResource::withoutWrapping();
    }
}
