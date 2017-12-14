<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\User;
use App\Http\Model\Role;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use DB;
/**
* 
*/
class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::orderBy('id','asc')
            ->where(function($query) use($request){
                //检测关键字
                $username = $request->input('username');
                //$email = $request->input('keywords2');
                //如果用户名不为空
                if(!empty($username)) {
                    $query->where('username','like','%'.$username.'%');
                }

            })
            ->paginate($request->input('num', 5));

        $title='用户列表';
        return view('admin.user.list',['user'=>$user,'request'=>$request,'title'=>$title]);
    }
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
//        1. 获取用户提交的表单数据

        $input = Input::except('_token');
        // dd($input);
//        2. 表单验证

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
            return redirect('user/create')
                ->withErrors($validator)
                ->withInput();
        }


//        3. 执行添加操作
         $user = new User();
         $user->username = $input['username'];
         $user->password = Hash::make($input['password']);
         $res = $user->save();
//        4. 判断是否添加成功
        if($res){
            return redirect('user')->with('msg','添加成功');
        }else{
            return redirect('user/create')->with('msg','添加失败');
        }		


	}

    /**
     * 用户修改
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //1. 根据传过来的ID获取要修改的用户记录
        $user = User::find($id);

        //2.返回修改页面（带上要修改的用户记录）
        return view('admin.user.edit',compact('user'));

        $res = User::find($id)->delete();
        $data = [];
        if($res){
            $data['error'] = 0;
            $data['msg'] ="修改成功";
        }else{
            $data['error'] = 1;
            $data['msg'] ="修改失败";
        }

        return $data;
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    // 1. 通过id找到要修改那个用户
        $user = User::find($id);

    // 2. 通过$request获取要修改的值
        $input = $request->only('username');

        //dd($input);

    // 3. 使用模型的update进行更新
        $res = $user->update($input);

    // 4. 根据更新是否成功，跳转页面
        if($res){
            return redirect('user');
        }else{
            return redirect('user/'.$user->id.'/edit');
        }
    }

    /**
     * 用户删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $res = User::find($id)->delete();
        $data = [];
        if($res){
            $data['error'] = 0;
            $data['msg'] ="删除成功";
        }else{
            $data['error'] = 1;
            $data['msg'] ="删除失败";
        }

        return $data;
    }






    /**
    * 用户授权页面
    **/
    public function auth($id){
        $title='用户授权';

        //要授权用户的id
        $user=User::find($id);

        //查看所有的角色表
        $roles=Role::get();

        //获取要授权用户已经拥有的角色
        $own_role=DB::table('user_role')->where('user_id',$id)->pluck('role_id')->all();

        return view('admin.user.auth',compact('user','roles','title','own_role'));
    }


    /**
    * 用户授权
    **/
    public function doauth(Request $request){
        //接收表单传过来的数据
        $input=$request->except('_token');

        DB::beginTransaction();

        try{
            //删除用户以前拥有的角色
            DB::table('user_role')->where('user_id',$input['user_id'])->delete();

            // 将角色数据添加到user_role表中
            if(isset($input['role_id'])){
                foreach ($input['role_id'] as $k=>$v){
                    DB::table('user_role')->insert(['user_id'=>$input['user_id'],'role_id'=>$v]);
                }
            }

        }catch (Exception $e){
            DB::rollBack();
        }

        DB::commit();

        //添加成功后，跳转到列表页
        return redirect('user')->with('msg','授权成功');
    }


}
