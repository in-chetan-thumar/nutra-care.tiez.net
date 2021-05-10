<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
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
        if (auth()->check() && !auth()->user()->isAdmin()) {
            if (\Session::has('locale')) {
                app()->setLocale(\Session::get('locale'));
            }
        }
        return $next($request);
    }
}
