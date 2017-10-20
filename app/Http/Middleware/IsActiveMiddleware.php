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
        //先判断是否登录
        if (session('homeuser')) {
            //获取当前帐号的状态
            $status = session('homeuser')->status;

            if ($status == 2) {
                $data = [
                    'status'=>1,
                    'msg'=>'请先验证邮箱激活帐号获得发帖回帖权限'
                ];

                return $data;
            }
            return $next($request);
        } else {
            $data = [
                'status'=>1,
                'msg'=>'请先登录才能执行该操作'
            ];

            return $data;
        }

    }
}
