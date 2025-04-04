<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }

        if (!Auth::user()->hasRole($role)) {
            abort(403, 'unauthorized access.');
        }

        return $next($request);
    }
}
