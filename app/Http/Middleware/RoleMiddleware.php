<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  \Illuminate\Http\Request  $request
     * @param  string|array  $role
     * @return \Symfon\Component\HttpFondation\Response
     */

    public function handle($request, Closure $next, $roles)
    {
        if (!$request->user() || !in_array($request->user()->role->name, $roles)) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    return $next($request);
    }
}
