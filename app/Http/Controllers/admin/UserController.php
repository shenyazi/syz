<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
* 
*/
class UserController extends Controller
{
	/**
	 * 显示用户添加的表单
	 */
	public function create()
	{
		$title = '用户添加';
		return view('admin.user.add',['title' => $title]);
	}



	/**
	 * 用户数据添加
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function store(Request $request){
		// dd($request->all());
		//1.获取用户提交的请求数据
		$input = $request->all();
		// dd($input);
		//将数据保存到data_user表中
		$res = DB::table('data_user')->insert(['username']=>$input['username'],'password'=>$input['password']);


		//如果添加成功,跳转到用户列表页
		if($res){
            return redirect('/user/list');
        }else{
        //如果失败，返回到添加页面
            return back();
        }

}
}

