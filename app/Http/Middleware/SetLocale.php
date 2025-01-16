<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Check if a 'lang' parameter exists in the URL
        if ($request->has('lang')) {
            $locale = $request->get('lang');
            // Store locale in session
            Session::put('locale', $locale);
        }

        // Set the locale for the current session
        App::setLocale(Session::get('locale', 'en')); // Default to 'en' if no locale is set

        return $next($request);
    }
}

