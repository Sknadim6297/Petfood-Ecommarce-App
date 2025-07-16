<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StoreIntendedUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Store the current URL as intended URL if user is not authenticated
        // and this is a GET request (not POST, PUT, etc.)
        if (!Auth::check() && $request->isMethod('GET') && !$request->expectsJson()) {
            session(['url.intended' => $request->fullUrl()]);
        }
        
        return $next($request);
    }
}
