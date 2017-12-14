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
    public function index(Request $request)
    {//dd($request->input('num'));
        $goods = Good::orderBy('id','asc')
        ->where(function($query) use($request){
                //检测关键字
                $gname = $request->input('gname');
                //如果商品名称不为空
                if(!empty($gname)) {
                    $query->where('gname','like','%'.$gname.'%');
                }
            })->paginate($request->input('num',5));
        $title = '商品列表页';
        // $goods = Good::paginate(5);

        // dd($goods);
        return view('admin.good.index',compact('title','goods','request'));

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
        // $cates = Cate::all();
        $cates = (new Cate) -> tree();
        // $cates = Cate::select(['cate_pid'])->get();
     //  dd($cates);
        $cate = [];
        $id = [];
        foreach($cates as $k => $v)
        {
            $cate[] =  $v -> cate_pid;
            $id[] = $v -> cate_id;
        }
        // dd($cate);
        $cate = array_unique($cate);
        
        

        return view('admin.good.add',compact('title','cates','id','cate'));
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
       // dd($request->pid);
         $input = $request->except('_token','gpicc');
        // dd($input);
        $rule = [
            'gname'=>'required',
            "gprice"=>'required|numeric',
            "goodsNum"=>'required',
		    // 'gpic' => 'required|dimensions:width=80,height=80',
			// 'avatar' => 'dimensions:width=100,height=100'
            

        ];

        $mess = [
            'gname.required'=>'商品名称必须输入',
            'gprice.required'=>'商品价格必须输入',
            'gprice.numeric'=>'商品价格必须为数字',
            'goodsNum.required'=>'商品上线数量必须输入',
			// 'gpic.required'=>'商品图片必须上传',
		    // 'gpic.dimensions'=>'图片大小必须为80*80',
            
            
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
            return redirect('/admin/good')->with('success','添加商品成功!');
        }else{
            return back()->with('errors','添加商品失败!!!');
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
       
        $good = Good::find($id);
      
       
        $cates = (new Cate) -> tree();
       
        $cate = [];
      
        foreach($cates as $k => $v)
        {
            $cate[] =  $v -> cate_pid;
           
        }
        $cate = array_unique($cate);
       // dd($cate);
        $title = '更新商品';
        return view('admin.good.edit',compact('title','id','good','cate','cates'));

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
        
        $goods = $request->except('_token','_method','gpicc');
         $rule = [
            'gname'=>'required',
            "gprice"=>'required|numeric',
            "goodsNum"=>'required',
			// 'gpic' => 'required|dimensions:width=80,height=80',
            

        ];

        $mess = [
            'gname.required'=>'商品名称必须输入',
            'gprice.required'=>'商品价格必须输入',
            'gprice.numeric'=>'商品价格必须为数字',
            'goodsNum.required'=>'商品上线数量必须输入',
			// 'gpic.required'=>'商品图片必须上传',
			// 'gpic.dimensions'=>'图片大小为80*80',
            
            
        ];
         
        $validator = Validator::make($goods,$rule,$mess);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $r = Good::where('id',$id)->update($goods);
        if($r){
          
            return redirect('/admin/good')->with('msg','更新商品成功!');
                
        }else{
            return back()->with('msg','更新商品失败!!!');
        }

       // dd($good->id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Good::destroy($id);
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
    public function zt( $id)
    {

        $goods = Good::find($id);
        $good = $goods->gstatus;
        if($good == "1" || $good == "3")
        {
            $goods->gstatus = 2;
        }else{
            $goods->gstatus = 3;
        }
        
        $a =  $goods -> save();
        if($a){
          
            return redirect('/admin/good');
                
        }else{
            return back()->with('msg','失败');
        }
        
    }
}