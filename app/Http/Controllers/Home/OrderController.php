<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Address;
use App\Http\Model\Order;
session_start();

class OrderController extends Controller
{

     //
     public function pay(){

 	  	//判断是否登录,如果没有登录就跳转到登录 
        if (empty(session('id'))) {
           
           return redirect('home/login');
        }

        $addr=Address::where('uid',session('id'))->get();
        
        return view('home.order.pay',compact('addr'));
     }


     //地址添加
     public function addr(Request $request){
     	$address=new Address;
     	$address -> name = $request->name;
    	$address -> phone = $request->phone;
    	// $address -> sheng = $request->sheng;
    	// $address -> shi = $request->shi;
    	// $address -> xian = $request->xian;
    	$address -> adress = $request->sheng.$request->shi.$request->xian.$request->adress;
    	$address -> uid = session('id');
    	// $address -> is_default = $request->input('is_default', 1);// env('HOST','localhost')
    	
    	if($address->save()) {
    		return back()->with('success','添加成功');
    	}else{
    		return back()->with('error','添加失败');
    	}
     }




     //
     public function finish(){
     	$order=new Order;
     	foreach($_SESSION['cart'] as $k=>$v){
     		$order->oid=$this->getNewOrderNum();
     		$order->gpic=$v->gpic;
     		$order->gname=$v->gname;
     		$order->gprice=$v->gprice;
     		$order->bcnt=$v->bcnt;
     		$order->gid=$v->id;
     		$order->uid=session('id');

     		$order->save();
     	}
     	

     	return view('home.order.success');
     }


    private function getNewOrderNum()
    {
    	return date('YmdHis').rand(1000,9999);
    }
}
