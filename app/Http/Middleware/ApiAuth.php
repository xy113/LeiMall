<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuth
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
        $session = $request->input('__session');
        if (!isset($session['uid']) || !isset($session['username'])){
            return ajaxError(999, 'not login');
        }
        return $next($request);
    }
}
