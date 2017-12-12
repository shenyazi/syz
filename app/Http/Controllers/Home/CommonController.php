<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\FriendLink;
use App\Http\Model\Cate;

class CommonController extends Controller
{
    //
    public function __construct(){
    	//前台首页的友情链接
	    	$friendlinks=FriendLink::get();

	    view()->share('friendlinks', $friendlinks);
    }


    //商城前台分类列表
    static public function getCatePid($pid = 0)
    {
        $data = Cate::where('cate_pid',$pid)->get();
        $arr = [];
        foreach ($data as $key => $value) {
            $value['sub'] = self::getCatePid($value['cate_id']);
            $arr[] = $value;
        }
        return $arr;
    }
}
