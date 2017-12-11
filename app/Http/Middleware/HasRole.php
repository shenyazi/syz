<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Model\User;

class HasRole
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
       

        //获取当前用户执行执行的操作对应的路由对应的控制器的方法

            //当前正在执行的路由对应的控制器的方法名
            $route = \Route::current()->getActionName();
            // dd($route);


            //获取当前用户所拥有的权限
            $user_id = session('user')->id;

            $user = User::find($user_id);
            
            //获取当前用户拥有的角色
            $roles = $user->role;
            // dd($roles);


            //定义一个数组，存放用户拥有的所有权限
            $arr = [];
            
            //根据拥有的角色获取权限
            foreach ($roles as $k=>$v){
                 //根据角色找到相关的权限的数组
                foreach ($v->auth as $m=>$n){
                    $arr[] = $n->desc;
                }
            }

        // dd($arr);
            //去除权限中重复的记录
            $arr = array_unique($arr);


            //判断当前路由对应的控制器的方法是否在用户拥有的权限中
            if(in_array($route,$arr)){
                return $next($request);
            }else{
                return redirect('errors/auth');
            }

    }
    
}
