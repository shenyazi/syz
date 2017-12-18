<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Good;
use App\Http\Model\Cart;
use App\Http\Model\Users;
session_start();

class GoodController extends CommonController
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $goods = Good::find($id);
       // dd($goods);
        return view('home/good/xq',compact('goods'));
    }

  



    /**
     * 商品加入购物车
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tocart(Request $request,$id)
    {

        // $users=Users::find(session('id'));
        // dd($users);

        if (empty($_SESSION['cart'][$id])){
          $_SESSION['cart'][$id] = $goods=Good::find($id);
          $_SESSION['cart'][$id]->bcnt =$request->num;
       } else {
            $_SESSION['cart'][$id]->bcnt += $request->num;
       }
        
        
        // if($users->cart_goods()->save($goods,['num'=>$request->num])){
             return view('home.cart.tocart');
        // }


    }


    /** 
    *   购物车页面
    **/
    public function cart(){

        //读取当前用户的购物车信息
        // $users=Users::find(session('id'));
        // $goods=$users->cart_goods;
        // // dd($goods);

        // $_SESSION['rmb']=0;
        // $_SESSION['num']=0;
        // foreach($goods as $k=>$v){
        //     $money=$v->gprice * $v->pivot->num;
        //     $_SESSION['rmb'] += $money;
        //     $_SESSION['num'] += $v->pivot->num;
        // }

        // return view('home.cart.index',compact('goods'));
        // dd($_SESSION['cart']);
        return view('home.cart.index');
    }



    //加 1
     public function jia($id)
        {
            $_SESSION['cart'][$id] -> bcnt++;
            return view('home.cart.index');
        }
        
        // 减1
        public function jian($id)
        {
            $_SESSION['cart'][$id] -> bcnt--;
            if ($_SESSION['cart'][$id] -> bcnt<1){
                $_SESSION['cart'][$id] -> bcnt = 1;
            }
           return view('home.cart.index');
        }
        
        // 移除某个商品
        public function del($id)
        {
            unset($_SESSION['cart'][$id]);
            return view('home.cart.index');
        }
}
