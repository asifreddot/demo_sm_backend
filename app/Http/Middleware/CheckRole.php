<?php

namespace App\Http\Middleware;

use App\Utils\ResponseUtils;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use function App\Utils\ResponseUtils;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();
        if (! $user || ! in_array($user->role, $roles)) {
            return ResponseUtils::message(['errors' => ["Access denied"]], 'Permission error',401);
        }
        return $next($request);
    }
}
