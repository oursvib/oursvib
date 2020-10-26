<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        if (Auth::user()->role == 1) {
            return $next($request);
        }

        $destinations = [
            2 => 'vendors',
            3 => 'avendorsfile',
            4 => 'customer',
        ];

        return redirect(route($destinations[Auth::user()->role]));

    }
}
