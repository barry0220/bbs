<?php

namespace App\Http\Middleware;

use Closure;

class HomeIsLoginMiddleware
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
        //验证是否登录
        if (session('homeuser')) {

                return $next($request);
        } else {

            return view('errors.error',compact('info'));
        }
    }
}
