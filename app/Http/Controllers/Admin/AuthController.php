<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Auth;

class AuthController extends Controller
{
    //
    public function create(){
    	$title='权限添加';
    	return view('admin.auth.create',compact('title'));
    }


    //
    public function store(Request $request){
    	$input=$request->except('_token');

    	$res=Auth::create($input);

    	//判断
    	if($res){
    		return redirect('/auth')->with('msg','添加成功');
    	}else{
    		return back()->with('errors','添加失败');
    	}
    }


    
    //
    public function index(Request $request){
    	//获取所有的权限
    	$auths = Auth::orderBy('id','asc')
		    ->where(function($query) use($request){
		        //检测关键字
		        $name = $request->input('name');
		        //如果用户名不为空
		        if(!empty($name)) {
		            $query->where('name','like','%'.$name.'%');
		        }
		    })->paginate($request->input('num', 5));
    	
    	$title='权限列表';

    	return view('admin.auth.index',compact('auths','request','title'));
    }



    //
    public function edit($id){
    	$auth=Auth::find($id);
    	
    	$title='权限修改';

    	return view('admin.auth.edit',compact('title','auth'));
    }



    //
    public function update(Request $request,$id){
     	
    	$input=$request->except('_token');
		
		$res=Auth::find($id)->update($input);;

    	//判断
    	if($res){
    		return redirect('/auth')->with('msg','更新成功');
    	}else{
    		return back()->with('errors','更新失败');
    	}
    } 



    //
    public function destroy($id){
    	$res=Auth::find($id)->delete();

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
    
}
