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
        if (!$request->expectsJson() && $request->inertia()) {
            abort(409, '', ['X-Inertia-Location' => url()->route('voyager.login')]);
        } else if (!$request->expectsJson()) {
            return route('voyager.login');
        }
    }
}
