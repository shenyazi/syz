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
		$lunbos = Lunbo::orderBy('id','asc') -> where(function($query)) use($request){
			$btitle = $request->input('btitle');

			//如果标题不为空
			if(!empty($btitle)){
				$query->where('')
			}
		}
		
		
		//加载页面
		return view('admin.lunbo.index',compact('data','search','count','request'));

	}

	public function create()
	{
		return view('admin.lunbo.create');
	}


	public function store(Request $request)
	{

	}
	public function show($id)
    {
        //
    }
}