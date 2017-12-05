<?php

namespace App\Http\Controllers\Admin;

class ManagerController extends Controller
{
	//加载修改密码页面
	public function passedit(){
		return view('admin.manager.passedit');
	}

}