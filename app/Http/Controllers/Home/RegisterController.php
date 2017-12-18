<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\SendReminderEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Model\Users;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Session;
use App\SMS\SendTemplateSMS;
use App\SMS\M3Result;
use Illuminate\Support\Facades\Hash;

class RegisterController extends CommonController
{
	//    演示队列发送邮件
    /**
     * 发送提醒的 e-mail 给指定用户。
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function sendReminderEmail()
    {

        $user = User::findOrFail(15);
        $this->dispatch(new SendReminderEmail($user));
    }

    /**
     * 手机注册页面
     */
    public function PhoneRegister()
    {
        return view('home.login.register');
    }

    /**
     * 发送短信验证码的方法
     */
    public function sendCode(Request $request)
    {
        $input = $request->except('_token');

        $tempSms = new SendTemplateSMS();

        // 参数1 手机号
        $telphone = $input['phone'];

        // 参数2
        $m = mt_rand(1000,9999);
        // $m = 1999;
        
        $arr = [$m,5];

        $M3Result = new M3Result();
        $M3Result = $tempSms->sendTemplateSMS($telphone,$arr,1);
        //发送验证码成功后，将验证码存入session中
        // session('telphone',$m);
        Session::put('telphone', $m);
        
       
        // dd(session::get('telphone'));
        return $M3Result->toJson();
    }

    


    /**
     * 实现手机号注册功能
     */
    public function doPhoneRegister(Request $request)
    {	
    	//获取用户提交的数据
    	$input = $request->all();
    	
    	//($input);
    	// dd($input);
    	// 表单验证
    	$rule = [
            'phone'=>'required|unique:home_user,phone',
            "password"=>'required|between:6,20',
            'repass' => 'same:password',
            'code' => 'required'
        ];
        $message = [
            'phone.required'=>'请正确输入手机号',
            'phone.unique' => '手机号已被注册',
            'password.required'=>'必须输入密码',
            'password.between'=>'密码必须在6到20位之间',
            'repass.same'=>'两次密码输入不一致',
            'code.required' =>'必须输入验证码' 
        ];
        $validators =  Validator::make($input,$rule,$message);
        // dd($validators->withErrors);
        if ($validators->fails()) {
        	dd(111);
            return redirect('home/register')
                ->withErrors($validators)
                ->withInput();

	       
	        }
	       //dd(1);
	         $input = $request->except('repass');
	         //检查手机是否存在
	         //dd($input['phone']);
	         
	         $phone = Users::where('phone',$input['phone'])->first();
	       
	         if($phone){

            		return redirect('home/register')->with('errors','手机已注册');
     			}
     		//判断验证码
     		// dd($input['code']);
     		//dd(Session::get('telphone'));
     		if($input['code'] != Session::get('telphone')){
	       		  
	           return redirect('home/register')->with('errors','验证码错误');

    		
	    	//向用户表添加注册用户
	    	
    	}else{
    		
    		 $inputs['phone'] = $input['phone'];
	    	 $inputs['password'] = Hash::make($input['password']);
	    	 $inputs['is_active'] = 1;
	    	// //给token字段赋值
	    	 $inputs['token'] = $input['_token'];

	    	$res = Users::create($inputs);
	    	if($res){
	    		return redirect('home/login');
	    	}else{
	    		return back();
	    	}

    }
}
    	
            
    		
	

	/**
     * 查看手机是否重复
     * 
     */
    // public function phoneajax(Request $request)
    // {
    //     $data = $request->all();
    //     $res = Users::where('phone',$data['phone'])->first();
    //     if($res){
    //         return 1;
    //     }else{
    //         return 0;
    //     }

    // }

    /**
     * 邮箱注册页面
     */
    public function EmailRegister()
    {
        return view('home.login.register');
    }
    /**
     * 邮箱注册
     */
    
    public function doEmailRegister(Request $request)
    {
    	// dd(111);
    	// 接收客户端传过来
    	$input = $request->except('_token');

    	//表单验证
    	$input['name'] = $input['email'];
    	$input['password'] = Hash::make($input['password']);
    	$input['is_active'] = 0;
    	$input['token'] = $input['password'];

        $a = Users::where('email',$input['email'])->first();
        
        if($a){
        	 return redirect('home/register')->with('errors','该邮箱已注册');
        }
    	$res = Users::create($input);
    	  //dd($res->id);
    	if($res){

           // 4. 给注册邮箱发送注册邮件

			//参数一： 对方收到的邮件模板
			//参数二：邮件模板中需要的变量
			//参数三：关于邮件注册的变量，如发件人，主题、收件人等信息
           Mail::send('home.email.active', ['user' => $res], function ($m) use ($res) {
				$m->to($res->email, $res->name)->subject('邮箱激活!');
           });
            
           return redirect('home/login');

       }else{
       	 //dd(sadsadas);
           return back();
       }

    }

    /**
     * 邮箱激活方法
     */
    public function active(Request $request)
    {
        //就是找到要激活的用户，将这条记录的is_active字段的值改成1


		//1.先找到要激活的用户

        $user = Users::find($request['id']);


		//2.验证激活链接的有效性
        if($request['key'] != $user->token){
            return "无效的激活链接";
        }
        $res = $user->update(['is_active'=>1]);

        if($res){
            return redirect('home/login');
        }else{
            return "激活失败，请重新注册";
        }
        
    }
    public function Forget()
    {
    	return view('home/forget');
    }
    public function doForget($name)
    {

    	// 获取$name
    	$name;

    	// if(@){
    	//   // send('sadsa')
    	// }else{
    	// 
    	// }
    	//  跳转
    	//  
    	if($name){
    		strpos($name, "@");
    		Mail::send('email.forget');
    	}else{

        
        //如果是是有效邮箱，发送找回密码邮件
        // dd($name);
        $user = Users::where('email',$name)->first(); 
        //dd($user);
        if($user){
             //给邮箱发送激活链接
            //参数1 邮件发送模板   参数2 向模板中传递的遍历   参数3  的参数$user,设置跟邮件相关的信息如收件人、邮件主题等
            Mail::send('home.email.forget', ['user' => $user], function ($m) use ($user) {
            //to(收件人的邮箱，收件人的名字)
                $m->to($user->email, $user->name)->subject('重置密码!');
            });
            return back()->with("errors","重置密码申请成功，去邮箱查看");
        }
    }

    //重置密码页面
    public function reset(Request $request)
    {
    	$user = Users::find($request['id']);
    	// dd($user);
    	// $a = $user->name;
    	if($request['key'] != $user->token)
    	{
    		return '无效的连接';

    	}

    	return view('home.reset',compact('name'));
    }

    //重置密码界面
    public function doreset()
    {
    	// dd(111);
        // $user = Users::where('email',$name)->first();
        // $pass = Hash::make(['password'])
        
        // $re =  $user->update(['password'=>$pass]);
        // if($re){
        //     return redirect('home/login');
        // }else{
        //     return bakc()->with("errors","密码修改失败");
        // }
    }
}