<?php

namespace App\Http\Middleware;

use Closure;
use Hexadog\ThemesManager\Http\Middleware\ThemeLoader as HexadogThemeLoader;

class ThemeLoader extends HexadogThemeLoader
{
    public function handle($request, Closure $next, $theme = null)
    {
        if (!$theme) {
            $theme = config('settings.default_theme', 'shehabalqudiry/default');
        }
        return parent::handle($request, $next, $theme);
    }
}
