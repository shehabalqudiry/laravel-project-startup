<?php

namespace App\Http\Middleware;

use Closure;
use Hexadog\ThemesManager\Http\Middleware\ThemeLoader as HexadogThemeLoader;

class ThemeLoader extends HexadogThemeLoader
{
    public function handle($request, Closure $next, $theme = null)
    {
        // Check if request url starts with admin prefix
        if (!$theme) {
            // Set a specific theme for matching urls
            $theme = config('settings.default_theme', 'shehabalqudiry/default');
        }
        // dd(theme_asset('/'));
        // Call parent Middleware handle method
        return parent::handle($request, $next, $theme);
    }
}
