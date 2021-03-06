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

//前台首页文章跳转页
Route::get('home/work/{id}','Home\HomeController@work');

//商城前台登录的路由
Route::get('home/login','Home\LoginController@login');
Route::post('home','Home\LoginController@doLogin');
//前台退出
Route::get('home/logout','Home\LoginController@logout');

//商城前台手机注册
Route::get('home/register','Home\RegisterController@PhoneRegister');
Route::post('home/dophoneregister','Home\RegisterController@doPhoneRegister');

//忘记密码
Route::get('home/forget','Home\RegisterController@Forget');
Route::get('home/forget/a/{name}','Home\RegisterController@doForget');

//找回密码
Route::get('home/reset/{id}','Home\RegisterController@reset');

//重置密码
Route::post('home/doreset','Home\RegisterController@doreset');

//发送验证码
Route::post('home/sendcode','Home\RegisterController@sendCode');
Route::post('home/phoneregister','Home\RegisterController@doPhoneRegister');

//邮箱注册
Route::post('home/emailregister','Home\RegisterController@doEmailRegister');

//邮件激活
Route::get('home/active','Home\RegisterController@active');

// 前台商品列表页 详情页路由
Route::group(['prefix'=>'home','namespace' => 'Home'],function () {
    Route::get('/list', 'ListController@list_');   // 商品列表页
    Route::get('/list_search', 'ListController@list_Search');   // 商品搜索页
    Route::get('/comment', 'CommentController@comment');   // 商品评论
    Route::get('/list/{id}', 'ListController@cate');   // 类别跳转
    Route::post('/list/search', 'ListController@search');   // 搜索
    Route::post('/list','ListController@orderby');   // 排序
});

// 前台用户中心页路由组
Route::group(['prefix'=>'person','namespace' => 'Person'],function () {
    Route::get('/index', 'PersonController@index');
    Route::resource('/address', 'AddressController');
    Route::get('/order','OrderController@index');
    Route::post('/order/{id}','OrderController@change');
    Route::resource('/information', 'InformationController');
    Route::post('/upload','InformationController@upload');
    Route::get('/collection', 'CollectionController@index');
    Route::post('/collection/{id}','CollectionController@collection');
});

// 商城前台商品详情
Route::resource('home/xq','Home\GoodController');

//商品加入购物车
Route::post('home/cart/{id}','Home\GoodController@tocart');
Route::get('home/cart','Home\GoodController@cart');
Route::get('home/cart/jia/{id}','Home\GoodController@jia');
Route::get('home/cart/jian/{id}','Home\GoodController@jian');
Route::get('home/cart/del/{id}','Home\GoodController@del');

//商品结算,商品订单
Route::get('home/order/pay','Home\OrderController@pay');
Route::get('home/order/finish','Home\OrderController@finish');


//地址添加(商品结算)
Route::post('/home/order/address','Home\OrderController@addr');

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

 	// 角色管理
 	Route::resource('role','RoleController');
 	Route::get('role/auth/{id}','RoleController@auth');
    Route::post('role/doauth','RoleController@doauth');
   

    // 权限管理
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

	//订单管理
	Route::resource('order','OrderController');
   
});


//商城后台轮播图管理模块
Route::resource('lunbo','Admin\LunboController');


//权限不够时跳转的路径
Route::get('errors/auth',function(){
	return view('errors.auth');
});

  	


 	



















// 商品模块
//  Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
// 	route::resource('good','GoodController');
	
// });

