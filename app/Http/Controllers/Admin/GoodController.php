<?php

namespace App\Http\Controllers\Admin;
use App\Http\Model\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = '添加商品';
        return view('admin.good.add',compact('title'));
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
         $input = $request->except('_token');
         dd($input);
         return ($input);
        // 验证
        $rule = [
            
            'gname'=>'required',
            'gprice'=>'regex:pattern',
            'goodNum'=>'required',
            'gpic'=>'required',
            'goodsDes'=>'required',
            'gstatus'=>'required',
        ];


        $mess = [
            'gname.required'=>'用户名必须输入'
           
        ];


        $validator =  Validator::make($input,$rule,$mess);
        //如果表单验证失败 passes()
          if ($validator->fails()) {
              return redirect('admin/good/add')
                  ->withErrors($validator)
                  ->withInput();
          }
        $good = new Good();

        $arr = $request->except(['_token']);
        foreach($arr as $k=>$v)
        {
            $good -> $k = $v;
            $good -> save();
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
