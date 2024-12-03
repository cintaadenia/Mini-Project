<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        // Debugging line
        if (!Auth::user()->hasRole($role)) {
            abort(403, 'User does not have the right roles');
        }

        return $next($request);
    }
}
