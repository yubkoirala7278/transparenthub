<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page');
        }

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->hasRole(['admin'])) {
                return $next($request);
            }
            Auth::logout();
            return redirect()->route('login')->with('error', 'You dont have permission to access this page!');
        }
        return redirect()->route('login')->with('error', 'You dont have permission to access this page!');
    }
}
