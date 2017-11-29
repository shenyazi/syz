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

//商城后台友情链接模块
Route::resource('friendlink','Admin\FriendlinkController');

//商城后台文章管理模块
Route::resource('work','Admin\WorkController');