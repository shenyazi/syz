<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Work;
use App\Http\Model\Cate;
use App\Http\Model\Lunbo;
use App\Http\Model\Good;

class HomeController extends CommonController
{
   //前台首页
    public function index(){
    	$title='商城首页';
    	
    	//调用前台分类
    	$data=self::getCatePid();
    	// dd($data);

    	//购物指南文章模块
    	$works=Work::get();
	 	
	 	//轮播图
	 	$lunbo=Lunbo::get();

        //首页的商品新品秒杀
        $goods=Good::where('gstatus','1')->orderby('id','desc')->take(4)->get();
        $good=Good::where('gstatus','1')->take(4)->get();
	    // dd($goods);


    	return view('home.index',compact('title','data','works','lunbo','goods','good'));
    }



    //文章跳转
    public function work(Request $request){
        $work=Work::find($request->id);
        $title='购物指南文章';
        // dd($work);

        return view('home.work',compact('work','title'));
    }


}
