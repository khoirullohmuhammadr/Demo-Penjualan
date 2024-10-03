<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SalesEnsureMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => false,
                'message' => 'You need to log in to access this resource.',
            ], 401);
        }

        // Mengecek apakah pengguna memiliki peran yang sesuai
        $user = Auth::user();
        if ($user->role !== $role) {
            return response()->json([
                'status' => false,
                'message' => 'You do not have permission to access this resource.',
            ], 403); // Forbidden
        }

        return $next($request);
    }
}
