<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // If the user is trying to access an admin route, redirect to admin login
        if ($request->is('admin/*')) {
            return route('backpack.auth.login');
        }

        // Otherwise redirect to the standard login
        return route('login');
    }
}
