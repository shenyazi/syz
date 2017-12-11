<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

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
        return view('admin.register');
    }

}