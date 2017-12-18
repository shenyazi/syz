<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;     

class LoginController extends Controller
{
	/**
     * 返回登录页面
     *
     * @return \Illuminate\Http\Response
     */
    
    public function login()
    {
    	if(session('user'))
        {
            return back();
        }
    	return view('home.login.index');
    }

    public function dologin(Request $request)
    {
        // dd(111);
        // $name=$request->input('name');
        // $password=$request->input('password');


    	
        $num = $request->input('num');
        $password = $request->input('password');
        $data = Users::where('email',$num)->orWhere('phone',$num)->orWhere('name',$num)->first();
        // dd($data);
     
            
                if (Hash::check($password, $data->password)){
                   Session::put('user',$data);
                   Session::put('id',$data->id);
                    return redirect('/home')->with('success','登录成功');
                }else{
                    return back()->with('error','用户名或密码错误')->withinput();
                }
            
    }

    public function logout(Request $request)
    {
        session(['user'=>null]);
        $request->session()->flush();
        return redirect('home/login');
    }




}