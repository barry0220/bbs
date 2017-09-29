<?php

namespace App\Http\Middleware;

use Closure;

class isLoginMiddleware
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
        if(session('user')){
            return $next($request);
        }else{
            return redirect('admin/login')->with('errors','非法访问');
        }

    }
}
