@extends('layouts.admin')

@section('title')
    后台轮播图修改页面
@endsection

@section('content')
	<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <div class="col-lg-12">
                      <ul class="breadcrumb">
                          <li><a href="#"><i class="icon-home"></i> Home</a></li>
                          <li><a href="#">轮播图</a></li>
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
                             <b>修改轮播图</b>        
                          </header>

                          <div class="panel-body">
                              <form class="form-horizontal" role="form" action='/lunbo/{{$lunbo->id}}')}}" method='post' enctype='multipart-data'>
                                  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 control-label">标题:	</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"  name='btitle' value='{{$lunbo->btitle}}'>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputPassword1" class="col-lg-2 control-label">链接地址:</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"  name='burl' value='{{$lunbo->burl}}'>
                                      </div>
                                  </div>
                                 <div class="form-group">
                                      <label for="inputPassword1" class="col-lg-2 control-label">图片:</label>
                                      <div class="col-lg-6">
                                          
                                          <input type="file" class="form-control"  name='bimg'>
                                          <img src="{{$lunbo->bimg}}" alt='' width="100">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputPassword1" class="col-lg-2 control-label">状态:</label>
                                      <div class="col-lg-6">
                                          <input type="radio" id="inputPassword1" name='bstatus' @if($lunbo->status==1) checked @endif value='1'>开启&nbsp;
                                          <input type="radio" id="inputPassword1" name='bstatus' @if($lunbo->status==0) checked  @endif value='0'>关闭
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