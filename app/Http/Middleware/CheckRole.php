<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        $user = $request->user();
        if (! $user) {
            abort(403);
        }

        $allowedRoles = explode('|', $roles);
        if (! in_array($user->role, $allowedRoles, true)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
