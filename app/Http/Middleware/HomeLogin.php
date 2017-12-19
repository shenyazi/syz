<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class HomeLogin
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
//        如果用户已经登录，放行
        if(Session::get('home_user')){
            return $next($request);
        }else{
            return redirect('home/login')->with('errors','请先登录');
        }

    }
}
