<?php

namespace App\Providers;

use Hexadog\MenusManager\Facades\Menus;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Modules\MasterData\App\Models\Setting;

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
        if (Schema::hasTable('settings')) {
            $settings = Setting::get()->pluck('value', 'key');
        }
        view()->share('menu', Menus::register('main'));
        view()->share('settings', $settings);
        // JsonResource::withoutWrapping();
    }
}
