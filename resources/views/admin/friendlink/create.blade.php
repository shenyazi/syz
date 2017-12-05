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
                          <li><a href="#">友情链接</a></li>
                          <li class="active">添加</li>
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
                             <b>添加友情链接的表单</b>
                          </header>

                          <div class="panel-body">
                              <form class="form-horizontal" role="form" action="{{url('friendlink')}}" method='post' enctype='multipart-data'>
                                  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 control-label">链接名字:	</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"  name='lname' value="{{old('lname')}}">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputPassword1" class="col-lg-2 control-label">链接地址:</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"  name='lurl' value="{{old('lurl')}}">
                                      </div>
                                  </div>
                                 <div class="form-group">
                                      <label for="inputPassword1" class="col-lg-2 control-label">链接图标:</label>
                                      <div class="col-lg-6">
                                          <input type="file" class="form-control"  name='limg'>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputPassword1" class="col-lg-2 control-label">链接状态:</label>
                                      <div class="col-lg-6">
                                          <input type="radio" id="inputPassword1" name='status' value='1'>开启&nbsp;
                                          <input type="radio" id="inputPassword1" name='status' value='0'>关闭
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      			{{csrf_field()}}
                                          <button type="submit" class="btn btn-danger">添 加</button>
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