<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminForcePasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = auth('admin')->user();

        if (! $admin || ! $admin->must_change_password) {
            return $next($request);
        }

        if ($request->routeIs('admin.password.change', 'admin.password.change.update', 'admin.logout')) {
            return $next($request);
        }

        return redirect()->route('admin.password.change');
    }
}
