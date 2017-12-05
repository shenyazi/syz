<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CateController extends Controller
{
    /**
     * 作用: 修改排序
     * @author: 景玉圆
     * @date: 2017-12-2 15:36
     * @param: Request $request 请求对象
     * @return: 返回修改排序是否成功
     */
    public function changeOrder(Request $request)
    {
        // 修改要排序的那条记录的cate_order字段为用户指定的值
        // 要修改的那条记录
        $cate_id = $request->input('cate_id');

        // 要修改的值
        $cate_order = $request->input('cate_order');

        $cate = Cate::find($cate_id);
        $res = $cate->update(['cate_order'=>$cate_order]);

        if($res){
            $data = [
                'status' => 0,
                'msg' => '修改排序成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '修改排序失败'
            ];
        }

        return $data;
    }


    /**
     * 作用: 显示分类页面
     * @author: 景玉圆
     * @date: 2017-12-1 20:20
     * @param: $cates 分类数据
     * @return: 将分类数据返回到分类列表页
     */

    public function index()
    {
//        $cates = Cate::paginate(8);
        $cates = Cate::tree();

        return view('admin.cate.list', compact('cates'));
    }

    /**
     * 作用: 显示添加分类页面
     * @author: 景玉圆
     * @date: 2017-12-3 16:25
     * @param: $cateOne 所有一级分类数据
     * @return: 将一级分类数据返回到添加分类页
     */
    public function create()
    {
        $cateOne = Cate::where('cate_pid',0)->get();

        return view('admin.cate.create',compact('cateOne'));
    }

    /**
     * 作用: 保存用户提交的数据
     * @author: 景玉圆
     * @date: 2017-12-3 17:50
     * @param: Request $request 请求对象
     * @return: 添加成功返回列表页, 添加失败返回添加页面
     */
    public function store(Request $request)
    {
        $input = Input::except('_token');


        $rule = [
            'cate_name'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,10',
            "cate_order"=>'required|regex:/^[0-9_]+$/u|between:1,2'
        ];


        $mess = [
            'cate_name.required'=>'分类名必须输入',
            'cate_name.regex'=>'分类名必须汉字字母下划线',
            'cate_name.between'=>'分类名必须在2到10位之间',
            'cate_oreder.required'=>'密码必须输入',
            'cate_order.regex'=>'排序必须为数字',
            'cate_order.between'=>'排序必须在1到2位之间'
        ];


        $validator =  Validator::make($input,$rule,$mess);
        //如果表单验证失败 passes()
        if ($validator->fails()) {
            return redirect('admin/cate/create')
                ->withErrors($validator)
                ->withInput();
        }

        $cate = new Cate();
        $cate->cate_name = $input['cate_name'];
        $cate->cate_order = $input['cate_order'];
        $cate->cate_pid = $input['cate_pid'];

        $res = $cate->save();

        if($res){
            return redirect('admin/cate')->with('msg','添加成功');
        }else{
            return back();
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
     * 作用: 修改分类
     * @author: 景玉圆
     * @date: 2017-12-4 9:40
     * @param: $id 要修改的分类id
     * @return: 根据分类id显示修改页面
     */
    public function edit($id)
    {
        // 根据传过来的ID获取要修改的用户记录
        $cate = Cate::find($id);

        return view('admin.cate.edit',compact('cate'));
    }

    /**
     * 作用: 更新用户提交的数据
     * @author: 景玉圆
     * @date: 2017-12-4 10:30
     * @param: Request $request 请求对象
     *         $id 要修改的分类id
     * @return: 修改成功返回列表页, 修改失败返回修改页
     */
    public function update(Request $request, $id)
    {
        // 通过id找到要修改的那条用户记录
        $cate = Cate::find($id);

        // 通过$request获取要修改的值
        $input = $request->only('cate_name');

        $rule = [
            'cate_name'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,10',
        ];


        $mess = [
            'cate_name.required'=>'分类名必须输入',
            'cate_name.regex'=>'分类名必须汉字字母下划线',
            'cate_name.between'=>'分类名必须在2到10位之间',
        ];


        $validator =  Validator::make($input,$rule,$mess);
        //如果表单验证失败 passes()
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // 使用模型的update进行更新
        $res = $cate->update($input);

        // 判断更新是否成功, 跳转页面
        if($res){
            return redirect('admin/cate')->with('msg','修改成功');
        }else{
            return back();
        }

    }

    /**
     * 作用: 删除分类
     * @author: 景玉圆
     * @date: 2017-12-3 19:35
     * @param: $id 要删除的分类id
     *         $catel 该分类下子类的数量
     * @return: 分类下有子类删除失败, 再判断是否删除成功
     */
    public function destroy($id)
    {

        // 计算分类下的子类个数
        $catel = Cate::where('cate_pid', '=', $id)->count();


        // 如果没类下有子类删除失败, 再判断是否删除成功
        $data = [];
        if($catel){
            $data['error'] = 2;
            $data['msg'] = '删除失败,分类下有子类';
        }else{

            $res = Cate::find($id)->delete();


            if($res){
                $data['error'] = 0;
                $data['msg'] = '删除成功';
            }else{
                $data['error'] = 1;
                $data['msg'] = '删除失败';
            }
        }
        return $data;
    }
}
