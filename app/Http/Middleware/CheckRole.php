<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()) {
            return redirect('login');
        }

        $userRole = $request->user()->role->nama;
        $intendedRoute = null;

        if ($userRole === 'admin') {
            $intendedRoute = 'dashboard';
        } elseif ($userRole === 'user') {
            $intendedRoute = 'tasks.index';
        }

        if ($intendedRoute && !$request->routeIs($intendedRoute)) {
            return redirect()->route($intendedRoute);
        }

        return $next($request);
    }
}
