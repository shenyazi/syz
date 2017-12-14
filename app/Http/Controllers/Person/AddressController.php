<?php

namespace App\Http\Controllers\Person;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Address;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    /**
     * 作用：显示分类页面
     * @author：景玉圆
     * @date：2017-12-8 10：20
     * @param：$address 收货地址数据
     * @return：将收货地址数据返回到分类列表页
     */
    public function index()
    {

        $address = Address::get();

        return view('person.address.index', compact('address'));
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
     * 作用：添加收货地址
     * @author：景玉圆
     * @date：2017-12-8 17：20
     * @param：Request $request 请求对象
     *         $input 去除token的用户要添加的地址
     * @return：添加成功返回列表页, 添加失败返回添加页面
     */
    public function store(Request $request)
    {
        $input = Input::except('_token');

        $rule = [
            'name'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,6',
            'phone'=>'required|regex:/^[0-9]{11}$/',
            'address'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:12,100',
        ];


        $mess = [
            'name.required'=>'收货人必须输入',
            'name.regex'=>'收货人必须是汉字字母下划线',
            'name.between'=>'收货人必须在2到6位之间',
            'phone.required'=>'手机号码必须输入',
            'phone.regex'=>'手机号码必须是11位',
            'address.required'=>'收货地址必须输入',
            'address.between'=>'收货地址必须在12到100位之间',
        ];


        $validator =  Validator::make($input,$rule,$mess);
        //如果表单验证失败 passes()
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $address = new Address();
        $address->name = $input['name'];
        $address->phone = $input['phone'];
        $address->address = $input['address'];

        $res = $address->save();

        if($res){
            return redirect('person/address')->with('msg','添加成功');
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
     * 作用：跳转到修改页面
     * @author：景玉圆
     * @date：2017-12-9 14：35
     * @param：$id 要修改地址的id
     * @return：根据地址id显示修改页面
     */
    public function edit($id)
    {
        //  根据传过来的ID获取要修改的地址
        $address = Address::find($id);

        return view('person.address.edit', compact('address'));
    }

    /**
     * 作用：修改收货地址
     * @author：景玉圆
     * @date：2017-12-11 20：40
     * @param：Request $request 请求对象
     *         $id 要修改的地址id
     *         $address 要修改地址的信息
     *         $addr 当前用户的所有地址信息
     *         $input 给要设置默认地址的字段赋值1
     *         $input 修改地址的数据
     * @return：根据地址id显示修改页面
     */
    public function update(Request $request, $id)
    {
        $address = Address::find($id);

        if(($request->only('isStaAdd'))['isStaAdd'] == 2){

            $addr = Address::where('uid','=',$address->uid)->get();
            foreach($addr as $k=>$v)
            {
                $v->isStaAdd = 0;
                $v->save();
            }

            $input = ['isStaAdd' => 1];
        }else{
            $input = $request->only('name','phone','address');

            $rule = [
                'name'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:2,6',
                'phone'=>'required|regex:/^[0-9]{11}$/',
                'address'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:12,100',
            ];


            $mess = [
                'name.required'=>'收货人必须输入',
                'name.regex'=>'收货人必须是汉字字母下划线',
                'name.between'=>'收货人必须在2到6位之间',
                'phone.required'=>'手机号码必须输入',
                'phone.regex'=>'手机号码必须是11位',
                'address.required'=>'收货地址必须输入',
                'address.between'=>'收货地址必须在12到100位之间',
            ];


            $validator =  Validator::make($input,$rule,$mess);
            //如果表单验证失败 passes()
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }



        // 使用模型的update进行更新
        $res = $address->update($input);

        // 判断更新是否成功, 跳转页面
        if($res){
            return redirect('person/address')->with('msg','修改成功');
        }else{
            return back();
        }
    }

    /**
     * 作用：删除收货地址
     * @author：景玉圆
     * @date：2017-12-10 16：10
     * @param：$id 要删除地址的id
     *         $data 是否删除成功信息
     * @return：根据地址id显示修改页面
     */
    public function destroy($id)
    {
        $res = Address::find($id)->delete();

        $data = [];

        if($res){
            $data['error'] = 0;
            $data['msg'] = '删除成功';
        }else{
            $data['error'] = 1;
            $data['msg'] = '删除失败';
        }

        return $data;
    }
}