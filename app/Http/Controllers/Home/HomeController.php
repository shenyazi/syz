<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Work;
use App\Http\Model\Cate;
use App\Http\Model\Lunbo;

class HomeController extends CommonController
{
   
    public function index(){
    	$title='商城首页';
    	
    	//调用前台分类
    	$data=self::getCatePid();
    	// dd($data);

    	//购物指南文章模块
    	$works=Work::get();
	 	
	 	//轮播图
	 	$lunbo=Lunbo::get();
	    	


    	return view('home.index',compact('title','data','works','lunbo'));
    }


}
