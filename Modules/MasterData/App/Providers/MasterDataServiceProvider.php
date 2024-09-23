<?php

namespace Modules\MasterData\App\Providers;

use Illuminate\Support\Facades\Blade;
use Hexadog\MenusManager\Facades\Menus;
use Illuminate\Support\ServiceProvider;
use app\Repositories\User\UserRepositoryInterface;
use Closure;
use Modules\MasterData\App\Models\User;
use Modules\MasterData\App\Services\Dashboard\UserService;
use Modules\MasterData\App\Services\Dashboard\SettingService;
use Modules\MasterData\App\Services\Dashboard\ActivityLogService;
use Modules\MasterData\App\Services\Dashboard\AdditionalDataService;
use Modules\MasterData\App\Repositories\Dashboard\Setting\SettingInterface;
use Modules\MasterData\App\Repositories\Dashboard\Setting\SettingRepository;
use Modules\MasterData\App\Repositories\Dashboard\ActivityLogs\ActivityLogInterface;
use Modules\MasterData\App\Repositories\Dashboard\ActivityLogs\ActivityLogRepository;
use Modules\MasterData\App\Repositories\Dashboard\AdditionalData\AdditionalDataInterface;
use Modules\MasterData\App\Repositories\Dashboard\AdditionalData\AdditionalDataRepository;
use Modules\MasterData\App\Repositories\Dashboard\Admin\UserInterface;
use Modules\MasterData\App\Repositories\Dashboard\Admin\UserRepository;
use Modules\MasterData\App\Repositories\Dashboard\Area\AreaInterface;
use Modules\MasterData\App\Repositories\Dashboard\Area\AreaRepository;
use Modules\MasterData\App\Repositories\Dashboard\Branch\BranchInterface;
use Modules\MasterData\App\Repositories\Dashboard\Branch\BranchRepository;
use Modules\MasterData\App\Repositories\Dashboard\City\CityInterface;
use Modules\MasterData\App\Repositories\Dashboard\City\CityRepository;
use Modules\MasterData\App\Repositories\Dashboard\Client\ClientInterface;
use Modules\MasterData\App\Repositories\Dashboard\Client\ClientRepository;
use Modules\MasterData\App\Repositories\Dashboard\Country\CountryInterface;
use Modules\MasterData\App\Repositories\Dashboard\Country\CountryRepository;
use Modules\MasterData\App\Repositories\Dashboard\Currency\CurrencyInterface;
use Modules\MasterData\App\Repositories\Dashboard\Currency\CurrencyRepository;
use Modules\MasterData\App\Repositories\Dashboard\Department\DepartmentInterface;
use Modules\MasterData\App\Repositories\Dashboard\Department\DepartmentRepository;
use Modules\MasterData\App\Repositories\Dashboard\RoleAndPermission\PermissionInterface;
use Modules\MasterData\App\Repositories\Dashboard\RoleAndPermission\PermissionRepository;
use Modules\MasterData\App\Repositories\Dashboard\RoleAndPermission\RoleInterface;
use Modules\MasterData\App\Repositories\Dashboard\RoleAndPermission\RoleRepository;
use Modules\MasterData\App\Services\Dashboard\AreaService;
use Modules\MasterData\App\Services\Dashboard\BranchService;
use Modules\MasterData\App\Services\Dashboard\CityService;
use Modules\MasterData\App\Services\Dashboard\ClientService;
use Modules\MasterData\App\Services\Dashboard\CountryService;
use Modules\MasterData\App\Services\Dashboard\CurrencyService;
use Modules\MasterData\App\Services\Dashboard\DepartmentService;
use Modules\MasterData\App\Services\Dashboard\RoleAndPermissionService;

class MasterDataServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'MasterData';

    protected string $moduleNameLower = 'masterdata';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));

    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);

        app()->bind(ActivityLogInterface::class, ActivityLogRepository::class);
        app()->bind(ActivityLogService::class, function ($app) {
            return new ActivityLogService($app->make(ActivityLogInterface::class));
        });

        app()->bind(UserInterface::class, UserRepository::class);
        app()->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserInterface::class));
        });

        app()->bind(RoleInterface::class, RoleRepository::class);
        app()->bind(PermissionInterface::class, PermissionRepository::class);
        app()->bind(RoleAndPermissionService::class, function ($app) {
            return new RoleAndPermissionService($app->make(RoleInterface::class), $app->make(PermissionInterface::class));
        });

        app()->bind(AdditionalDataInterface::class, AdditionalDataRepository::class);
        app()->bind(AdditionalDataService::class, function ($app) {
            return new AdditionalDataService($app->make(AdditionalDataInterface::class));
        });




        app()->bind(AreaInterface::class, AreaRepository::class);
        app()->bind(AreaService::class, function ($app) {
            return new AreaService($app->make(AreaInterface::class));
        });



        app()->bind(BranchInterface::class, BranchRepository::class);
        app()->bind(BranchService::class, function ($app) {
            return new BranchService($app->make(BranchInterface::class));
        });



        app()->bind(CityInterface::class, CityRepository::class);
        app()->bind(CityService::class, function ($app) {
            return new CityService($app->make(CityRepository::class));
        });



        app()->bind(ClientInterface::class, ClientRepository::class);
        app()->bind(ClientService::class, function ($app) {
            return new ClientService($app->make(ClientRepository::class));
        });


        app()->bind(CountryInterface::class, CountryRepository::class);
        app()->bind(CountryService::class, function ($app) {
            return new CountryService($app->make(CountryRepository::class));
        });


        app()->bind(CurrencyInterface::class, CurrencyRepository::class);
        app()->bind(CurrencyService::class, function ($app) {
            return new CurrencyService($app->make(CurrencyRepository::class));
        });

        app()->bind(DepartmentInterface::class, DepartmentRepository::class);
        app()->bind(DepartmentService::class, function ($app) {
            return new DepartmentService($app->make(DepartmentRepository::class));
        });

        app()->bind(SettingInterface::class, SettingRepository::class);
        app()->bind(SettingService::class, function ($app) {
            return new SettingService($app->make(SettingInterface::class));
        });

    }

    /**
     * Register commands in the format of Command::class
     */
    protected function registerCommands(): void
    {
        // $this->commands([]);
    }

    /**
     * Register command Schedules.
     */
    protected function registerCommandSchedules(): void
    {
        // $this->app->booted(function () {
        //     $schedule = $this->app->make(Schedule::class);
        //     $schedule->command('inspire')->hourly();
        // });
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'lang'));
        }
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $this->publishes([module_path($this->moduleName, 'config/config.php') => config_path($this->moduleNameLower . '.php')], 'config');
        $this->mergeConfigFrom(module_path($this->moduleName, 'config/config.php'), $this->moduleNameLower);
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);
        $sourcePath = module_path($this->moduleName, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);

        $componentNamespace = str_replace('/', '\\', config('modules.namespace') . '\\' . $this->moduleName . '\\' . ltrim(config('modules.paths.generator.component-class.path'), config('modules.paths.app_folder', '')));
        Blade::componentNamespace($componentNamespace, $this->moduleNameLower);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<string>
     */
    public function provides(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }

        return $paths;
    }
}
