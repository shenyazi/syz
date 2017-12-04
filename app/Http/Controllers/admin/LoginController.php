<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use App\Http\Controllers\Controller;
use App\Org\code\Code;
require_once app_path().'\Org\code\Code.class.php';
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * 返回后台登录页面
     * @author xxx
     * @date   2017-11-28 20:00
     * @return view
     */

    public function login()
    {
        return view('admin/login');  
    }


    public function yzm()
    {
        $code = new Code();
        $code->make();
    }
    // 验证码生成
    public function captcha($tmp)
    {
        $phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase->build(4);
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(220, 210, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        \Session::flash('code', $phrase);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }

    /**
     * 处理登录逻辑
     */
    public function doLogin(Request $request)
    {
       
   //1.获取用户提交的登录数据
         $input = $request->except('_token');
          // dd($input);
       //2.对数据进行后台表单验证

       // Validator::make(要验证的数据，验证规则，提示信息)
       // 验证规则

        $rule = [
            'username'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:5,20',
            "password"=>'required|between:3,20'
        ];


        $mess = [
            'username.required'=>'用户名必须输入',
            'username.regex'=>'用户名必须汉字字母下划线',
            'username.between'=>'用户名必须在5到20位之间',
            'password.required'=>'密码必须输入',
            'password.between'=>'密码必须在3到20位之间'
        ];


        $validator =  Validator::make($input,$rule,$mess);
        //如果表单验证失败 passes()
          if ($validator->fails()) {
              return redirect('admin/login')
                  ->withErrors($validator)
                  ->withInput();
          }
       // 3.登录逻辑
       // 3.0验证码是否正确
       if( $input['code'] !=  Session::get('code')) {
           return redirect('admin/login')->with('errors','验证码错误');
       }

       // 3.1 判断是否有此用户
       $user = User::where('username',$input['username'])->first();
         // dd($user);
          if(!$user){
              return redirect('admin/login')->with('errors','用户名不存在');
          }
         //3.2密码是否正确
        if(Hash::check($request->password,$user->password)){
            Session::put('user',$user);
            return redirect('/admin');
        }else{
            return redirect('admin/login')->with('errors','密码不正确');
        }
       
       // 4.登录成功，将用户信息保存到session中，用于判断用户是佛登录以及获取登录用户信息
       
       // return redirect('admin/index');
       // 5登录失败，返回登录页面
    }

   
   /**
    * 后台首页的方法
    */
   public function index(){
      $title='商城后台';
      return view('admin.index',['title'=>$title]); 
   }
}
