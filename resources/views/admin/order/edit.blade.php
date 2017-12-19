@extends('layouts.admin')

@section('title',$title)

@section('content')
	<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <div class="col-lg-12">
                      <ul class="breadcrumb">
                          <li><a href="#"><i class="icon-home"></i> Home</a></li>
                          <li><a href="#"></a>订单管理</li>
                          <li class="active">修 改</li>
                      </ul>
                  </div>
              </div>
              <div class="row">
                 	@if (count($errors) > 0)
      						<div class="alert alert-danger">
      							<ul>
      								@foreach ($errors->all() as $error)
      									<li style="color:red">{{ $error }}</li>
      								@endforeach
      							</ul>
      						</div>
      					@endif
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <b>修改订单</b>        
                          </header>

                          <div class="panel-body">
                              <form class="form-horizontal" role="form" action='/order/{{$order->id}}')}}" method='post' enctype='multipart-data'>
                                  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 control-label">订单编号:	</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"  name='oid' value='{{$order->oid}}' readonly>
                                      </div>
                                  </div>
                                 
                                  <div class="form-group">
                                      <label for="inputPassword1" class="col-lg-2 control-label">订单状态:</label>
                                      <div class="col-lg-6">
                                          <input type="radio" id="inputPassword1" name='status' @if($order->status==0) checked @endif value='0'>未发货&nbsp;
                                          <input type="radio" id="inputPassword1" name='status' @if($order->status==1) checked  @endif value='1'>未收货
                                          <input type="radio" id="inputPassword1" name='status' @if($order->status==2) checked  @endif value='2'>已收货
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      			{{csrf_field()}}
                                          <input type="hidden" name="_method" value='put'>
                                          <button type="submit" class="btn btn-danger">更新</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                     
                  </div>
              </div>

            
              <!-- page end-->
          </section>
      </section>
@endsection