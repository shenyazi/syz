<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Good;
use App\Http\Model\Cart;

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
        //
        $goods=Good::find($id);
        // dd($goods);
        $cart=new Cart(); 
        $cart->user_id=1;
        $cart->good_id=$goods->id;
        $cart->num=$request->num;
        $cart->save();

        return view('home.cart.tocart');

    }


    /** 
    *   购物车页面
    **/
    public function cart(){
        return view('home.cart.index');
    }
}
