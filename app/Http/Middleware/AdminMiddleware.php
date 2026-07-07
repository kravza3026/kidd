<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Staff roles that may reach the admin panel. Per-action access is then
     * enforced by resource policies; the `admin` role bypasses all checks.
     *
     * @var list<string>
     */
    private const STAFF_ROLES = ['admin', 'manager', 'accountant', 'hr', 'seller', 'driver'];

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->hasAnyRole(self::STAFF_ROLES)) {
            return $next($request);
        }

        return redirect(route('home'));
    }
}
