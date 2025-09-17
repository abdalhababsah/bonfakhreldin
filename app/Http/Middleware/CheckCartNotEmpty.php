<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCartNotEmpty
{
    public function handle(Request $request, Closure $next)
    {
        if (collect(json_decode($request->cookie('cart'), true) ?? [])->isEmpty()) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}