<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Lunbo;
class LunboController extends Controller
{
	/**
	 * 加载轮播图列表
	 */
	public function index(Request $request)
	{
		//分页数据
		$count = $request -> input('count',4);
		$search = $request ->input('search','');
		$request=$request->all();

		//获取一页展示几条信息
		$data = lunbo::where('btitle','like','%'.$search.'%')->paginate($count);
		
		
		
		//加载页面
		return view('admin.lunbo.index',compact('data','search','count','request'));

	}

	public function create()
	{
		return view('admin.lunbo.create');
	}
	public function show($id)
    {
        //
    }
}