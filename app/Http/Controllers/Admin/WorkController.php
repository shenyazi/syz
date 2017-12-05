<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\Work;

class WorkController extends Controller
{
    /**
     * 文章添加的表单
     */
    public function create(){
    	$title='添加文章';
    	return view('admin.work.create',['title'=>$title]);
    } 



    /**
     * 接收表单传的数据插入数据库中
     */
    public function store(Request $request){
    	$input=$request->except('_token');

    	//表单验证
        $rule = [
            'wtitle'=>'required',
            "wcontent"=>'required',
            "wdesc"=>'required',
        ];

        $mess = [
            'wtitle.required'=>'文章标题必须输入',
            'wcontent.required'=>'文章内容必须输入',
            'wdesc.required'=>'文章描述必须输入',
            
        ];
		 
		$validator = Validator::make($input,$rule,$mess);

		if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        //实例化文章类
        $work=new Work();
        $work->wtitle=$request->wtitle;
	    $work->wcontent=$request->wcontent;
	    $work->wdesc=$request->wdesc;
	    
	    //插入数据库
	    if($work->save()){
	     	return redirect('/work')->with('success','添加文章成功!');
	    }else{
	        return back()->with('errors','添加文章失败!!!');
	    }

    }



    /**
     * 显示文章的列表页
     */
    public function index(Request $request){
    	$works = Work::orderBy('id','asc')
		    ->where(function($query) use($request){
		        //检测关键字
		        $wtitle = $request->input('wtitle');
		        //如果标题不为空
		        if(!empty($wtitle)) {
		            $query->where('wtitle','like','%'.$wtitle.'%');
		        }
		    })->paginate($request->input('num', 5));

    	$title='文章列表';
    	return view('admin.work.index',['title'=>$title,'works'=>$works,'request'=>$request]);
    }



    /**
     * 文章模块的修改
     */
    public function edit($id){
    	$title='修改文章';
    	$work=Work::find($id);
    	return view('admin.work.edit',['title'=>$title,'work'=>$work]);
    }



    /**
     * 文章信息的更新
     */
    public function update(Request $request,$id){
    	$input=$request->except('_token','_method');

    	//表单验证
        $rule = [
            'wtitle'=>'required',
            "wcontent"=>'required',
            "wdesc"=>'required',
        ];

        $mess = [
            'wtitle.required'=>'文章标题必须输入',
            'wcontent.required'=>'文章内容必须输入',
            'wdesc.required'=>'文章描述必须输入',
            
        ];
		 
		$validator = Validator::make($input,$rule,$mess);

		if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        //获取当前文章
        $work=Work::find($id);

        //把表单提交的内容添加到$work变量中
        $work->wtitle=$request->wtitle;
	    $work->wcontent=$request->wcontent;
	    $work->wdesc=$request->wdesc;
	    
	    //插入数据库
	    if($work->save()){
	     	return redirect('/work')->with('success','更新文章成功!');
	    }else{
	        return back()->with('errors','更新文章失败!!!');
	    }
    }



    /**
     * 文章的删除
     */
    public function destroy($id){
    	$res = Work::find($id)->delete();

        //删除成功后返回到ajax的数据
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
