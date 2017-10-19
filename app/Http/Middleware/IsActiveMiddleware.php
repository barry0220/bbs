<?php

namespace App\Http\Middleware;

use Closure;

class IsActiveMiddleware
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
        //获取当前帐号的状态
        $status = session('homeuser')->status;

        if ($status == 2) {
            $info = "您的帐号还没有激活,请先验证邮箱";
            return view('errors.error',compact('info'));
        }
        return $next($request);
    }
}
