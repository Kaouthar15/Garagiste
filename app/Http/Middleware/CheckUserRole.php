<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , ...$roles): Response
    {
        if (Auth::check()) { 
            $user = Auth::user();
            foreach ($roles as $role) {
                if ($role === 'admin' && $user->isAdmin) {
                    return $next($request);
                }
                if ($role === 'client' && $user->isClient) {
                    return $next($request);
                }
                if ($role === 'mechanic' && $user->isMechanic) {
                    return $next($request);
                }
            }
        }

        // Redirect unauthorized users to a specific route
        return redirect('/login');
    }
}
