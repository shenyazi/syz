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

Route::get('/admin',function(){
	$title='商城后台';
	return view('admin.index',['title'=>$title]);	
});
Route::get('/admin/add',function(){
	$title='添加商品';
	return view('/admin/add',['title'=>$title]);
});
route::resource('good','Admin\GoodController');

