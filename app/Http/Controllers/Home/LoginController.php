<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
	/**
     * 返回登录页面
     *
     * @return \Illuminate\Http\Response
     */
    
    public function login()
    {
    	//判断用户是否登录
    	if(session('huser')){
    		return back();
    	}
    	return view('home.login.index');
    }

    public function dologin(Request $request)
    {
    	// 获取浏览器提交的数据
    	$input = Input::except('_token');

    	$rule = [
            'username'=>'between:6,16',
            'password'=>'required|between:6,18'
        ];

        $mess = [
//            'username.required'=>'用户名必须输入',
            'username.between'=>'用户名的长度在6-16位之间',
            'password.required'=>'密码必须输入',
            'password.between'=>'密码的长度在6-18位之间',
        ];

    }

    
	
}