<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (! $user || ! $user->hasRole($roles)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses resource ini.');
        }

        return $next($request);
    }
}

