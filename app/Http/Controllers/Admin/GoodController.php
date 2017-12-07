<?php

namespace App\Http\Controllers\Admin;
use App\Http\Model\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Http\Model\Cate;

class GoodController extends Controller
{

    public function upload(Request $request)
    {
        $file = $request->file('gpicc');
        // dd($file);
        if($file->isValid()){

            $entension = $file->getClientOriginalExtension();  
             //上传文件的后缀名
             
            $newfile = date('YmdHis').mt_rand(1000,9999).'.'.$entension;
            
            //设置上传文件的目录
            $dirpath = public_path().'/uploads/';

            //将文件移动到本地服务器的指定的位置，并以新文件名命名
            //$file->move(移动到的目录, 新文件名);
             $file->move($dirpath, $newfile);

            //将文件移动到七牛云，并以新文件名命名
            //\Storage::disk('qiniu')->writeStream('uploads/'.$newfile, fopen($file->getRealPath(), 'r'));


            //将文件移动到阿里OSS
           // OSS::upload($newfile,$file->getRealPath());

            
            //将上传的图片名称返回到前台，目的是前台显示图片
            return $newfile;


         }   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index()
    {
        $title = '商品列表页';
        return view('admin.good.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = '添加商品';
        // 获取所有的分类名称
        $cates = Cate::tree();

        return view('admin.good.add',compact('title','cates'));
    }

    /**
     * Store a newly created resource in storage.
     * 添加商品
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 获取提交的数据
         $input = $request->except('_token','gpicc');
        // dd($input);
        $rule = [
            'gname'=>'required',
            "gprice"=>'required|numeric',
            "goodsNum"=>'required',
            

        ];

        $mess = [
            'gname.required'=>'商品名称必须输入',
            'gprice.required'=>'商品价格必须输入',
            'gprice.numeric'=>'商品价格必须为数字',
            'goodsNum.required'=>'商品上线数量必须输入',
            
            
        ];
         
        $validator = Validator::make($input,$rule,$mess);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
         $good = new Good;
         foreach($input as $k=>$v)
         {
             $good -> $k = $v;
             $good -> save();
         }

        if($good->save()){
            return redirect('/admin/good')->with('success','添加文章成功!');
        }else{
            return back()->with('errors','添加文章失败!!!');
        }
        
    
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
