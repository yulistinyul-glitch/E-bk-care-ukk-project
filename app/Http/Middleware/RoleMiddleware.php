<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek user login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Cek role
        if (strtolower(Auth::user()->role) !== strtolower($role)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
