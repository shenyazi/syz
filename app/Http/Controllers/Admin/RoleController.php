<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Role;
use App\Http\Model\Auth;
use DB;

class RoleController extends Controller
{
    //
    public function create(){
    	$title='角色管理';
    	return view('admin.role.create',compact('title'));
    }


    public function store(Request $request){
    	$input=$request->except('_token');
		
    	$res=Role::create($input);

    	//判断
    	if($res){
    		return redirect('/role')->with('msg','添加成功');
    	}else{
    		return back()->with('errors','添加失败');
    	}
    }


    //
    public function index(Request $request){
    	//获取所有的角色
    	$roles = Role::orderBy('id','asc')
		    ->where(function($query) use($request){
		        //检测关键字
		        $name = $request->input('name');
		        //如果用户名不为空
		        if(!empty($lname)) {
		            $query->where('name','like','%'.$name.'%');
		        }
		    })->paginate($request->input('num', 5));
    	
    	$title='角色列表';

    	return view('admin.role.index',compact('roles','request','title'));
    }



    //
    public function edit($id){
    	$role=Role::find($id);
    	// dd($role->name);
    	$title='角色修改';

    	return view('admin.role.edit',compact('title','role'));
    }



    //
    public function update(Request $request,$id){
    	$input=$request->except('_token');
		
		$role=Role::find($id);
    	$res=$role->update($input);

    	//判断
    	if($res){
    		return redirect('/role')->with('msg','更新成功');
    	}else{
    		return back()->with('errors','更新失败');
    	}
    }




    //
    public function destroy($id){
    	$res=Role::find($id)->delete();

    	$data=[];
		if($res){
            $data['error'] = 0;
            $data['msg'] ="删除成功";
        }else{
            $data['error'] = 1;
            $data['msg'] ="删除失败";
        }

		return $data;
    }


    //授权表单
    public function auth($id){
    	$title='角色授权';

        // return  \Route::current()->getActionName();

        //要授权的角色名
        $role=Role::find($id);

        //获取所有的权限
        $auths=Auth::get();

        //获取该角色已经拥有的权限
        $own_auth=DB::table('role_auth')->where('role_id',$id)->pluck('auth_id')->all();

    	return view('admin.role.auth',compact('title','role','auths','own_auth'));	
    }



    //
    public function doauth(Request $request){
        $input=$request->except('_token');

        DB::beginTransaction();

        try{
            //删除角色以前拥有的权限
            DB::table('role_auth')->where('role_id',$input['role_id'])->delete();
//            给当前角色重新授权


//        2. 将授权数据添加到role_auth表中
            if(isset($input['auth_id'])){
                foreach ($input['auth_id'] as $k=>$v){
                    DB::table('role_auth')->insert(['role_id'=>$input['role_id'],'auth_id'=>$v]);
                }
            }


        }catch (Exception $e){
            DB::rollBack();
        }

        DB::commit();

        //添加成功后，跳转到列表页
        return redirect('role')->with('msg','授权成功');
    }


}
