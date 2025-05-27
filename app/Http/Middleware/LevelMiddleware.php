<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LevelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response {
        $user = auth()->user();

        if (!$user) {
            return redirect('login');
        }

        if (!in_array($user->role_id, $roles)) {
            return redirect('login');
        }

        return $next($request);
    }
}
