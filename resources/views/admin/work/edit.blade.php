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
                          <li><a href="#">文章管理模块</a></li>
                          <li class="active">修改</li>
                      </ul>
                  </div>
              </div>
              <div class="row">
                 	@if (count($errors) > 0)
        						<div class="alert alert-danger">
        							<ul>
        								@if(is_object($errors))
        									@foreach ($errors->all() as $error)
        										<li style="color:red">{{ $error }}</li>
        									@endforeach
        								@else
        									<li style="color:red">{{ $errors }}</li>
        								@endif
        							</ul>
        						</div>
        					@endif
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <b>修改文章信息</b>
                          </header>

                          <div class="panel-body">
                              <form class="form-horizontal" role="form" action="/work/{{$work->id}}" method='post' enctype='multipart-data'>
                                  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 control-label">文章标题:	</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"  name='wtitle' value="{{$work->wtitle}}">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputPassword1" class="col-lg-2 control-label">文章描述:</label>
                                      <div class="col-lg-6">
                                          <textarea rows="5" cols="68" name='wdesc'>{{$work->wdesc}}</textarea>
                                      </div>
                                  </div>
                                 <div class="form-group">
                                      <label for="inputPassword1" class="col-lg-2 control-label">文章内容:</label>
                                      <div class="col-lg-6">
                                          <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
                                          <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
                                          <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>

                                          <script id="editor" name="wcontent" type="text/plain" style="width:800px;height:300px;">{!! $work->wcontent !!}</script>
                                          <script>
                                              var ue = UE.getEditor('editor');
                                          </script>
                                          <style>
                                              .edui-default{line-height: 28px;}
                                              div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                                              {overflow: hidden; height:20px;}
                                              div.edui-box{overflow: hidden; height:22px;}
                                          </style>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      			{{csrf_field()}}
                                            <input type="hidden" name="_method" value='put'>
                                          <button type="submit" class="btn btn-danger">更 新</button>
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
