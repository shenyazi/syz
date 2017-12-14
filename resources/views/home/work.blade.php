@extends('layouts.home')

@section('content')
				
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">

					<div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">购物指南文章</strong> / <small>小手册</small></div>
					</div>
					
					<div >
						<b id='wtitle'>标题:{{$work->wtitle}}</b>
						<div id='wcontent'>
							{!! $work->wcontent !!}
						</div>
						
					</div>
				</div>
				
				<style type="text/css">
					#wtitle{
						font-size:20px;
					}
					#wcontent{
						margin-top:66px;
						margin-left:333px;
						width:666px;
					}
				</style>
@endsection
			