<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\FriendLink;
use App\Http\Model\Cate;

class HomeController extends Controller
{
   
    public function index(){
    	$title='商城首页';
    	
    	//前台首页的友情链接
	    	$friendlinks=FriendLink::get();

	    //前台分类
	    	$cates=Cate::where('cate_pid',0)->take(9)->get();


    	return view('home.index',compact('friendlinks','cates','title'));
    }


}
