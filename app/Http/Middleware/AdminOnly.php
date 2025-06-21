<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('web')->user();

        if (!$user || !$user->is_admin) {
            abort(403, 'Akses hanya untuk admin.');
        }

        return $next($request);
    }
}
