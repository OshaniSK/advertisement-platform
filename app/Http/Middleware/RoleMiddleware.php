<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user()) {
            abort(403, 'Unauthorized');
        }

        $userRole = strtolower(trim($request->user()->role));
        $allowedRoles = array_map(function($role) {
            return strtolower(trim($role));
        }, $roles);

        if (! in_array($userRole, $allowedRoles)) {
            return match ($userRole) {
                'admin' => redirect()->route('admin.dashboard'),
                'advertiser' => redirect()->route('advertiser.dashboard'),
                default => redirect()->route('visitor.dashboard'),
            };
        }

        return $next($request);
    }
}
