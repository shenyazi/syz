<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\Lunbo;
use App\Services\OSS;
class LunboController extends Controller
{
	/**
	 * 加载轮播图列表
	 */
	public function index(Request $request)
	{
		$lunbo = Lunbo::orderBy('id','asc') -> where(function($query) use($request){
			$btitle = $request->input('btitle');

			//如果标题不为空
			if(!empty($btitle)){
				$query->where('btitle','like','%'.$btitle.'%');
			}
		})->paginate($request->input('num',5));
		
		
		//加载页面
		return view('admin.lunbo.index',['lunbo'=>$lunbo,'request'=>$request]);

	}

	public function create()
	{
		return view('admin.lunbo.create');
	}


	public function store(Request $request)
	{
		$input = $request->except('_token');
		//表单验证
        $rule = [
            'btitle'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,20',
            "burl"=>'required'
        ];

        $mess = [
            'btitle.required'=>'标题必须输入',
            'btitle.regex'=>'标题必须汉字字母下划线',
            'btitle.between'=>'标题必须在2到20位之间',
            'burl.required'=>'链接地址必须输入',
            
        ];

        $validator = Validator::make($input,$rule,$mess);

        if(!$validator->fails()){
        	$lunbo = new Lunbo;
        	$lunbo -> btitle=$request -> btitle;
        	$lunbo -> burl=$request -> burl;
        	$lunbo -> bstatus=$request -> bstatus;
        	$lunbo -> bimg=$request -> bimg;

        	//插入数据库
        	if($lunbo->save()){
        		return redirect('/lunbo')->with('msg','添加成功');
        	}else{
        		return back()->with('msg','添加失败');
        	}
        }else{
        	return back()
        		->withErrors($validator)
        		->withInput();
        }
	}
	public function show($id)
    {
        //
    }

    public function upload(Request $request)
    {
    	$file = $request->file('file_upload');

    	if($file->isValid()){
    		$entension = $file->getClientOriginalExtension();	//上传文件的后缀名
	        $newfile = date('YmdHis').mt_rand(1000,9999).'.'.$entension;
	   		
	   		//设置上传文件的目录
            $dirpath = public_path().'/uploads/';

            //将文件移动到阿里OSS
            OSS::upload($newfile,$file->getRealPath());

            //将返回的图片名称返回前台,在前台显示图片
            return $newfile;
    	}
    }


    /**
     * 轮播图修改
     */
    public function edit($id){
    	$lunbo=Lunbo::find($id);

    	return view('admin.lunbo.edit',['lunbo'=>$lunbo]);
    }

    /**
     * 轮播图更新
     */
    
    public function update(Request $request,$id){
    	//表单验证
        $this->validate($request, [
           'btitle'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,20',
            "burl"=>'required',
            'bimg'=>'required',
           
        ],[
            'btitle.required'=>'标题必须输入',
            'btitle.regex'=>'标题必须汉字字母下划线',
            'btitle.between'=>'标题必须在2到20位之间',
            'burl.required'=>'地址必须输入',
            'bimg.required'=>'图片必须上传',
        ]);

        //读取内容
        $lunbo=Lunbo::find($id);

        //提取内容
        $lunbo->btitle=$request->btitle;
        $lunbo->burl=$request->burl;
        $lunbo->bimg=$request->bimg;
        $lunbo->bstatus=$request->bstatus;

        // dd($lunbo);
        //插入数据表
		if($lunbo->save()){
            return redirect('lunbo')->with('msg','更新轮播图成功!');
        }else{
            return back()->with('msg','更新轮播图失败!!!');
        }
    }


    /**
	 * 删除链接数据
	 */
	public function destroy($id){
		$res = Lunbo::find($id)->delete();

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