<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DocklyPortalAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->session()->get('dockly_portal.token')) {
            return redirect()->route('tracking.login');
        }

        return $next($request);
    }
}
