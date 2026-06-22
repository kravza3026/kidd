<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Pennant\Feature;
use Symfony\Component\HttpFoundation\Response;

/**
 * Guards an admin route group behind its Pennant module flag. Apply as
 * `->middleware('module:product')`; a disabled module returns 404.
 */
class EnsureModuleEnabled
{
    public function handle(Request $request, Closure $next, string $module): Response
    {
        abort_unless(Feature::active("admin.{$module}"), 404);

        return $next($request);
    }
}
