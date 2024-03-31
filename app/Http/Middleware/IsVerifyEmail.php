<?php
namespace App\Http\Middleware;

use Closure;

class IsEmailVerified
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && !$request->user()->hasVerifiedEmail()) {
            return redirect()->route('login.show')->with('error', 'You must verify your email address to access this page.');
        }

        return $next($request);
    }
}