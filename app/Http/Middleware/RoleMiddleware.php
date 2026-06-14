<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {

            return redirect('/login');

        }

        if (Auth::user()->status === 'Suspended') {

            Auth::logout();

            return redirect('/login')
                ->with(
                    'error',
                    'Your account has been suspended.'
                );

        }

        if (!in_array(Auth::user()->role, $roles)) {

            abort(403, 'Unauthorized access');

        }

        return $next($request);
    }
}
