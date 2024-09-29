@php
    $user = auth('web')->user();

    $menu = \Hexadog\MenusManager\Facades\Menus::get('main');
    $menu->url(url('/'), __('Home'))->icon('bi bi-house-door-fill fe-16');
    $masterMenu = $menu->header('Master Data')->icon('bi bi-gear-fill');

    // General Config
    $masterMenu
        ->route('activitylog.index', fn() => __('Activity Log'))
        ->icon('bi bi-list-ol fe-16') // Activity log icon
        ->if(fn() => $user?->can('read-activity_log'));

    $masterMenu
        ->route('additionaldata.index', fn() => __('Additional Data'))
        ->icon('bi bi-database-fill fe-16') // Data icon
        ->if(fn() => $user?->can('read-additionaldata'));

    $masterMenu
        ->route('customfield.index', fn() => __('Custom Fields'))
        ->icon('bi bi-sliders fe-16') // Customization icon
        ->if(fn() => $user?->can('read-customfield'));

    $masterMenu
        ->route('setting.index', fn() => __('Settings'))
        ->icon('bi bi-gear-fill fe-16') // Settings icon
        ->if(fn() => $user?->can('read-setting'));

    // Zone Config (Submenu Example)
    $zoneMenu = $masterMenu->header('Zone')->icon('bi bi-globe fe-16');
    $zoneMenu
        ->route('country.index', fn() => __('Countries'))
        ->icon('bi bi-globe-fill fe-16') // Globe icon
        ->if(fn() => $user?->can('read-country'));

    $zoneMenu
        ->route('city.index', fn() => __('Cities'))
        ->icon('bi bi-map-pin-fill fe-16') // Map pin icon
        ->if(fn() => $user?->can('read-city'));

    $zoneMenu
        ->route('area.index', fn() => __('Areas'))
        ->icon('bi bi-map-fill fe-16') // Map icon
        ->if(fn() => $user?->can('read-area'));

    $zoneMenu
        ->route('currency.index', fn() => __('Currencies'))
        ->icon('bi bi-dollar-sign-fill fe-16') // Currency icon
        ->if(fn() => $user?->can('read-currency'));

    // Client Config
    $masterMenu
        ->route('client.index', fn() => __('Clients'))
        ->icon('bi bi-people-fill fe-16') // Users icon
        ->if(fn() => $user?->can('read-client'));

    // Admin Config
    $masterMenu
        ->route('user.index', fn() => __('Admin'))
        ->icon('bi bi-person-fill-lock fe-16') // User check icon
        ->if(fn() => $user?->can('read-user'));

    // Roles Config
    $masterMenu
        ->route('roles.index', fn() => __('Roles'))
        ->icon('bi bi-person-fill-lock fe-16') // User check icon
        ->if(fn() => $user?->can('read-user'));

    // Company Config
    $masterMenu
        ->route('branch.index', fn() => __('Branches'))
        ->icon('bi bi-house-fill fe-16') // Branch icon
        ->if(fn() => $user?->can('read-branch'));
    $masterMenu
        ->route('department.index', fn() => __('Departments'))
        ->icon('bi bi-briefcase-fill fe-16') // Briefcase icon
        ->if(fn() => $user?->can('read-department'));
@endphp
<x-menus-menu name="main" />
