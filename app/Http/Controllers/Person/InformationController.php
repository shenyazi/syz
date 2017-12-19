<?php

namespace App\Http\Controllers\Person;

use App\Http\Model\Information;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class InformationController extends Controller
{

    public function upload(Request $request)
    {
        $file = $request->file('facee');
//         dd($file);
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
     */
    public function index()
    {
        $info = Information::find(1);

        return view('person.information',compact('info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        $userinfo = Information::find($id);

        $input = $request->except('_token','_method','facee');

        $rule = [
            'nickname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:1,6',
            'realname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,6',
        ];


        $mess = [
            'nickname.required'=>'昵称必须输入',
            'nickname.regex'=>'昵称必须是汉字字母下划线',
            'nickname.between'=>'昵称必须在1到6位之间',
            'realname.required'=>'姓名必须输入',
            'realname.regex'=>'姓名必须是汉字字母下划线',
            'realname.between'=>'姓名必须在2到6位之间',
        ];

        $validator =  Validator::make($input,$rule,$mess);
            //如果表单验证失败 passes()
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }


        // 使用模型的update进行更新
        $res = $userinfo->update($input);

        // 判断更新是否成功, 跳转页面
        if($res)
        {
            return redirect('person/information')->with('msg','修改成功');
        }else{
            return back();
        }
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
