<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});





//商城前台的路由
Route::get('/home',function(){
	$title='商城前台首页';
	return view('home.index',['title'=>$title]);	
});


//商城前台登录的路由
Route::get('home/login','Home\LoginController@login');



//后台的登录的路由
Route::get('admin/login','Admin\LoginController@login');
Route::post('admin/dologin','Admin\LoginController@doLogin');

//后台登录时的验证码
Route::get('admin/yzm','Admin\LoginController@yzm');



Route::group(['middleware'=>'islogin','namespace'=>'Admin'],function (){
	
	//商城后台的路由
	Route::get('/admin','LoginController@index');

	//修改密码的路由
	Route::get('admin/passedit','Admin\LoginController@passedit');
	Route::post('admin/password','Admin\LoginController@password');

	//后台用户登出的路由
    Route::get('admin/logout','LoginController@logout');


	// 用户模块路由
 	Route::resource('user','UserController');

	// 分类管理路由模块
	Route::resource('admin/cate','CateController');
	// 修改分类的排序
	Route::post('admin/cate/changeorder', 'CateController@changeOrder');



	//商城后台友情链接模块
	Route::resource('friendlink','FriendlinkController');
	Route::post('/admin/upload','FriendlinkController@upload');

	//商城后台文章管理模块
	Route::resource('work','WorkController');
   
  


 	
});



















