<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // check if request is adminprefix
            if (strpos($request->path(), 'admin') === 0) {
                return route('admin.login');
            }

            // check if request is api prefix
            if (strpos($request->path(), 'api') === 0) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            // default to login page if none of the above conditions are met
            // return route('login');
            return route('login');
        }
    }
}
