<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
           // $url = url()->previous();
          //  $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();
            return redirect()->route('login');

        }

        if (Auth::user()->role == 4) {

            return $next($request);
        }

        $destinations = [
            1 => 'adminfile',
            2 => 'vendors',
            3 => 'avendorsfile',
        ];

        return redirect(route($destinations[Auth::user()->role]));
    }
}
