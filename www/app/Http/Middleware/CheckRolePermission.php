<?php

namespace App\Http\Middleware;

use Closure;

class CheckRolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {        
        if (!$request->user()->hasAnyRole(explode("|", $role))) {
            return redirect('/')
                ->with('status', 'danger')
                ->with('message', __('messages.Error: Permission access denied!'));
            ;
		}
		return $next($request);
    }
}
