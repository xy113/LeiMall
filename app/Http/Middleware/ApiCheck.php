<?php

namespace App\Http\Middleware;

use App\Models\MemberSession;
use Closure;

class ApiCheck
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
        $session_id = $request->input('session_id');
        if ($session_id) {
            $session = MemberSession::where('session_id', $session_id)->first();
            if ($session) {
                $value = unserialize($session->session_value);
                $request->merge(['__session'=>[
                    'uid'=>$value['uid'],
                    'username'=>$value['username']
                ]]);
            }
        }
        return $next($request);
    }
}
