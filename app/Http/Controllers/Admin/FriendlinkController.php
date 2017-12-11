<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\Friendlink;
use App\Services\OSS;

class FriendlinkController extends Controller
{
    /**
     * 友情链接添加的页面
     */
	public function create(){
		$title='友情链接添加';
		return view('admin.friendlink.create',['title'=>$title]);
	}


	
	/**
	 * 接收表单提交的数据
	 */
	public function store(Request $request){
		
		$input = $request->except('_token');
		// dd($input);

		//表单验证
        $rule = [
            'lname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,20',
            "lurl"=>'required'
        ];

        $mess = [
            'lname.required'=>'连接名必须输入',
            'lname.regex'=>'连接名必须汉字字母下划线',
            'lname.between'=>'连接名必须在2到20位之间',
            'lurl.required'=>'路径必须输入',
            
        ];
		 
		$validator =  Validator::make($input,$rule,$mess);
       
        if (!$validator->fails()) {

        	//实例化friendlink对象
	        $friend=new Friendlink;
	        $friend->lname=$request->lname;
	        $friend->lurl=$request->lurl;
	        $friend->status=$request->status;
	        $friend->limg=$request->limg;
	        
	        //插入数据库
			if($friend->save()){
	            return redirect('/friendlink')->with('msg','添加链接成功!');
	        }else{
	            return back()->with('msg','添加链接失败!!!');
	        }
			
		}else{
			 return back()
                  ->withErrors($validator)
                  ->withInput();
		}

	}



	/**
	 * 显示友情链接的列表
	 */
	public function index(Request $request){
		$friends = Friendlink::orderBy('id','asc')
		    ->where(function($query) use($request){
		        //检测关键字
		        $lname = $request->input('lname');
		        //如果用户名不为空
		        if(!empty($lname)) {
		            $query->where('lname','like','%'.$lname.'%');
		        }
		    })->paginate($request->input('num', 5));
				
		$title='友情链接列表';
		return view('admin.friendlink.index',['title'=>$title,'friends'=>$friends,'request'=> $request]);
	}



	/**
	 * 友情链接修改
	 */
	public function edit($id){
		//读取用户的信息
		$friend=Friendlink::findOrFail($id);
		$title='修改友情链接';

		return view('admin.friendlink.edit',['friend'=>$friend,'title'=>$title]);
	}



	/**
	 * 链接数据更新
	 */
	public function update(Request $request,$id){
		//表单验证
        $this->validate($request, [
           'lname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,20',
            "lurl"=>'required'
           
        ],[
            'lname.required'=>'链接名必须输入',
            'lname.regex'=>'链接名必须汉字字母下划线',
            'lname.between'=>'链接名必须在2到20位之间',
            'lurl.required'=>'路径必须输入',
        ]);

        //读取内容
        $friend=Friendlink::findOrFail($id);

        //提取内容
        $friend->lname=$request->lname;
        $friend->lurl=$request->lurl;
        $friend->status=$request->status;

        //插入数据表
		if($friend->save()){
            return redirect('/friendlink')->with('msg','更新链接成功!');
        }else{
            return back()->with('msg','更新链接失败!!!');
        }
	}



	/**
	 * 删除链接数据
	 */
	public function destroy($id){
		$res = Friendlink::find($id)->delete();

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



	/**
	 * 友情链接Logo上传(处理客户端传过来的图片)
	 */
	public function upload(Request $request)
	{

	    // $file = Input::file('file_upload');
		 $file = $request->file('file_upload');
	   
	    if($file->isValid()){
	        $entension = $file->getClientOriginalExtension();	//上传文件的后缀名
	        $newfile = date('YmdHis').mt_rand(1000,9999).'.'.$entension;
	   		
	   		//设置上传文件的目录
            $dirpath = public_path().'/uploads/';

            //将文件移动到本地服务器的指定的位置，并以新文件名命名
          	//$file->move(移动到的目录, 新文件名);
            $file->move($dirpath, $newfile);

            //将文件移动到七牛云，并以新文件名命名
            //\Storage::disk('qiniu')->writeStream('uploads/'.$newfile, fopen($file->getRealPath(), 'r'));


            //将文件移动到阿里OSS
           	// OSS::upload('uploads/'.$newfile,$file->getRealPath());

 			
            //将上传的图片名称返回到前台，目的是前台显示图片
            return $newfile;

	    }
	}


}
