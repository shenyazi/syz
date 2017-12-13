<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\SendReminderEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Model\Users;
use App\Http\Requests;

use App\SMS\SendTemplateSMS;
use App\SMS\M3Result;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
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
        $phone = $input['phone'];

        // 参数2
        $r = mt_rand(1000,9999);
        $arr = [$r,5];

        $M3Result = new M3Result();
        $M3Result = $tempSms->sendTemplateSMS($phone,$arr,1);
        //发送验证码成功后，将验证码存入session中
        session('phone',$r);

        return $M3Result->toJson();
    }


    /**
     * 实现手机号注册功能
     */
    public function doPhoneRegister(Request $request)
    {	
    	//获取用户提交的数据
    	$input = $request->except('_token','code');
    	// dd($input);
    	//向用户表添加注册用户
    	$input['password'] = Hash::make($input['password']);
    	$input['is_active'] = 1;
    	//给token字段赋值
    	$input['token'] = $input['password'];

    	$res = Users::create($input);
    	if($res){
    		return redirect('home/login');
    	}else{
    		return back();
    	}
    }


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

    	//添加成功后,返回刚才添加的那条用户记录
    	$res = Users::create($input);
    	// dd($res);
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

}