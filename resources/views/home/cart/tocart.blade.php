@extends('layouts.home')

@section('title','加入购物车')

@section('content')
	<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">购物车</strong> / <small>小手册</small></div>
					</div>
					
					<!-- <div class="content-wrap"> -->
						<h1 style='padding:15px'>加入购物车成功!!!</h1>
			       		<div class="sb-msg" style='padding-left:100px'>
					        <ul >
					            <li style='padding-bottom:10px'>恭喜您加入购物车成功.</li>
					            <li style='padding-bottom:55px'>您可以直接点击<a href="/home/cart"><b><i>跳转到购物车</i></b></a>, 或者继续<a href="/home/list"><b><i>浏览商品</i></b></a></li>
					        </ul>
						</div>
					<!-- </div> -->
				</div>
				
			
@endsection