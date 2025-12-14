<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Solo admin (role_id = 1) puede acceder
        if (auth()->user()->role_id != 1) {
            abort(403, 'Acceso denegado. Solo administradores.');
        }

        return $next($request);
    }
}
