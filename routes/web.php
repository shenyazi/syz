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


//商城后台的路由
Route::get('/admin',function(){
	$title='商城后台';
	return view('admin.index',['title'=>$title]);	
});


//用户后台登录页面
Route::get('admin/login','Admin\LoginController@login');

//用户后台登录
Route::post('admin/dologin','Admin\LoginController@doLogin');
//后台登录时的验证码
Route::get('admin/yzm','Admin\LoginController@yzm');


//后台的用户路由
Route::resource('user','Admin\UserController');


// //用户添加
// Route::get('/admin/user/add', 'Admin\UserController@add');
// //用户插入
// Route::post('/admin/user/insert', 'Admin\UserController@insert');
//后台验证用户密码
Route::get('crypt','Admin\LoginController@crypt');


//商城后台友情链接模块
Route::resource('friendlink','Admin\FriendlinkController');

//商城后台文章管理模块
Route::resource('work','Admin\WorkController');

// 分类管理路由模块
Route::resource('admin/cate','Admin\CateController');
// 修改分类的排序
Route::post('admin/cate/changeorder', 'Admin\CateController@changeOrder');




//资源路由
// Route::resource('good','GoodController');

