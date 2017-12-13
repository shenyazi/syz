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
Route::get('/home','Home\HomeController@index');	



//商城前台登录的路由
Route::get('home/login','Home\LoginController@login');
Route::post('home','Home\LoginController@doLogin');
//商城前台手机注册
Route::get('home/register','Home\RegisterController@PhoneRegister');
//发送验证码
Route::post('home/sendcode','Home\RegisterController@SendCode');

Route::post('home/phoneregister','Home\RegisterController@doPhoneRegister');
//邮箱注册
Route::get('home/emailregister','Home\RegisterController@EmailRegister');

Route::post('home/emailregister','Home\RegisterController@doEmailRegister');
//邮件激活
Route::get('home/active','Home\RegisterController@active');

//后台的登录的路由
Route::get('admin/login','Admin\LoginController@login');
Route::post('admin/dologin','Admin\LoginController@doLogin');

//后台登录时的验证码
Route::get('admin/yzm','Admin\LoginController@yzm');

//后台用户登出的路由
Route::get('admin/logout','Admin\LoginController@logout');






//后台路由组
// Route::group(['middleware'=>['islogin','hasrole'],'namespace'=>'Admin'],function (){
Route::group(['middleware'=>['islogin'],'namespace'=>'Admin'],function (){


	//商城后台的路由
	Route::get('/admin','LoginController@index');


	//修改密码的路由
	Route::get('admin/passedit','LoginController@passedit');
	Route::post('admin/password','LoginController@password');
		
  	

	// 用户模块路由
 	Route::resource('user','UserController');
 	Route::get('user/auth/{id}','UserController@auth');
 	Route::post('user/doauth','UserController@doauth');

 	//角色管理
 	Route::resource('role','RoleController');
 	Route::get('role/auth/{id}','RoleController@auth');
    Route::post('role/doauth','RoleController@doauth');
   

    //权限管理
    Route::resource('auth','AuthController');

	// 分类管理路由模块
	Route::resource('admin/cate','CateController');
	// 修改分类的排序
	Route::post('admin/cate/changeorder', 'CateController@changeOrder');

	// 商品路由模块
	Route::resource('admin/good','GoodController');
	Route::post('admin/uploadd','GoodController@upload');
	Route::get('admin/good/zt/{id}','GoodController@zt');


	
	//商城后台友情链接模块
	Route::resource('friendlink','FriendlinkController');
	Route::post('/admin/upload','FriendlinkController@upload');

	//商城后台购物指南文章管理模块
	Route::resource('work','WorkController');
   
	//商城后台轮播图管理模块
	Route::resource('lunbo','LunboController');
	Route::post('/admin/uploaddd','LunboController@upload');
   
});


//权限不够时跳转的路径
Route::get('errors/auth',function(){
	return view('errors.auth');
});

  	


 	



















// 商品模块
//  Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
// 	route::resource('good','GoodController');
	
// });

