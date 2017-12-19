<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Orders;

class OrderController extends Controller
{
    //
    public function index(Request $request){
		$orders = Orders::orderBy('id','asc')
		    ->where(function($query) use($request){
		        //检测关键字
		        $gname = $request->input('gname');
		        //如果用户名不为空
		        if(!empty($gname)) {
		            $query->where('gname','like','%'.$gname.'%');
		        }
		    })->paginate($request->input('num', 5));
			
		
		$title='订单列表';
		return view('admin.order.index',compact('title','orders','request'));
	}


	/**
	 * 友情链接修改
	 */
	public function edit($id){
		//读取用户的信息
		$order=Orders::findOrFail($id);
		$title='修改订单';

		return view('admin.order.edit',['order'=>$order,'title'=>$title]);
	}



	/**
	 * 链接数据更新
	 */
	public function update(Request $request,$id){
       
        //读取内容
        $order=Orders::findOrFail($id);

        //提取内容
        $order->status=$request->status;
        

        //插入数据表
		if($order->save()){
            return redirect('/order')->with('msg','更新状态成功!');
        }else{
            return back()->with('msg','更新状态失败!!!');
        }
	}



	/**
	 * 删除链接数据
	 */
	public function destroy($id){
		$res = Orders::find($id)->delete();

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
