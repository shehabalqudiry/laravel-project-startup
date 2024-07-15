<?php

namespace Modules\MasterData\App\Providers;

use App\Repositories\User\UserRepository;
use app\Repositories\User\UserRepositoryInterface;
use Modules\MasterData\App\Services\ActivityLogService;
use Modules\MasterData\App\Services\UserService;
use Hexadog\MenusManager\Facades\Menus;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\MasterData\App\Repositories\ActivityLogs\ActivityLogInterface;
use Modules\MasterData\App\Repositories\ActivityLogs\ActivityLogRepository;
use Modules\MasterData\App\Repositories\AdditionalData\AdditionalDataInterface;
use Modules\MasterData\App\Repositories\AdditionalData\AdditionalDataRepository;
use Modules\MasterData\App\Services\AdditionalDataService;

class MasterDataServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'MasterData';

    protected string $moduleNameLower = 'masterdata';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        // view()->share('menu', $menu);
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));
        $menu = Menus::get('main');

        $menu->url(url('/'), __('Home'))->icon('fe fe-home fe-16');
        $masterMenu = $menu->header('Master Data');

        // General Config
        $masterMenu->route('activitylog.index', fn () => __('Activity Log'))
            ->icon('fe fe-list fe-16') // Activity log icon
            ->if(fn () => /* auth()->check() && auth()->user()->can('view-activitylog')*/ true);

        $masterMenu->route('additionaldata.index', fn () => __('Additional Data'))
            ->icon('fe fe-database fe-16') // Data icon
            ->if(fn () => /* auth()->check() && auth()->user()->can('view-additionaldata')*/ true);

        $masterMenu->route('customfield.index', fn () => __('Custom Fields'))
            ->icon('fe fe-sliders fe-16') // Customization icon
            ->if(fn () => /* auth()->check() && auth()->user()->can('view-customfield')*/ true);

        $masterMenu->route('setting.index', fn () => __('Settings'))
            ->icon('fe fe-settings fe-16') // Settings icon
            ->if(fn () => /* auth()->check() && auth()->user()->can('view-setting')*/ true);


        // Zone Config (Submenu Example)
        $zoneMenu = $masterMenu->header('Zone');
        $zoneMenu->route('country.index', fn () => __('Countries'))
            ->icon('fe fe-globe fe-16') // Globe icon
            ->if(fn () => /* auth()->check() && auth()->user()->can('view-country')*/ true);

        $zoneMenu->route('city.index', fn () => __('Cities'))
            ->icon('fe fe-map-pin fe-16') // Map pin icon
            ->if(fn () => /* auth()->check() && auth()->user()->can('view-city')*/ true);

        $zoneMenu->route('area.index', fn () => __('Areas'))
            ->icon('fe fe-map fe-16') // Map icon
            ->if(fn () => /* auth()->check() && auth()->user()->can('view-area')*/ true);

        $zoneMenu->route('currency.index', fn () => __('Currencies'))
            ->icon('fe fe-dollar-sign fe-16') // Currency icon
            ->if(fn () => /* auth()->check() && auth()->user()->can('view-currency')*/ true);


        // Client Config
        $masterMenu->route('client.index', fn () => __('Clients'))
            ->icon('fe fe-users fe-16') // Users icon
            ->if(fn () => /* auth()->check() && auth()->user()->can('view-client')*/ true);

        // Admin Config
        $masterMenu->route('user.index', fn () => __('Users'))
            ->icon('fe fe-user-check fe-16') // User check icon
            ->if(fn () => /* auth()->check() && auth()->user()->can('view-user')*/ true);
        $masterMenu->route('auth.index', fn () => __('Authentication'))
            ->icon('fe fe-lock fe-16') // Lock icon
            ->if(fn () => /* auth()->check() && auth()->user()->can('view-auth')*/ true);

        // Company Config
        $masterMenu->route('branch.index', fn () => __('Branches'))
            ->icon('fe fe-git-branch fe-16') // Branch icon
            ->if(fn () => /* auth()->check() && auth()->user()->can('view-branch')*/ true);
        $masterMenu->route('department.index', fn () => __('Departments'))
            ->icon('fe fe-briefcase fe-16') // Briefcase icon
            ->if(fn () => /* auth()->check() && auth()->user()->can('view-department')*/ true);

        // // Conditional Menu Items
        // $masterMenu->route('profile.show', fn () => __('Profile'))
        //     ->icon('fe fe-user fe-16') // User icon
        //     ->if(fn () => auth()->check());
        // $masterMenu->route('login', fn () => __('Login'))
        //     ->icon('fe fe-log-in fe-16') // Login icon
        //     ->if(fn () => !auth()->check());
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

        app()->bind(AdditionalDataInterface::class, AdditionalDataRepository::class);
        app()->bind(AdditionalDataService::class, function ($app) {
            return new AdditionalDataService($app->make(AdditionalDataInterface::class));
        });


        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });


        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });



        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });



        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });



        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });


        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });


        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });

        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
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
