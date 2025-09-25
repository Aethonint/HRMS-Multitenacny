<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user has the required role
        if (! Auth::check() || ! Auth::user()->hasRole($role)) {
            // Redirect user if they don't have the required role
            return redirect('/')->withErrors(['message' => 'You do not have access to this section.']);
        }

        return $next($request); // Allow the request to continue if the role is valid
    
    }
}
