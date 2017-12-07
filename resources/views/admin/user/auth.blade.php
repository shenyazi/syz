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
                          <li><a href="#">用户管理</a></li>
                          <li class="active">用户授权</li>
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
                             <b>授权用户的表单</b>
                          </header>

                          <div class="panel-body">
                              <form class="form-horizontal" role="form" id="art_form" action="{{url('user/doauth')}}" method='post' >
                                  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 control-label">用户名:	</label>
                                      <div class="col-lg-6">
                                          <input type="hidden" name="user_id"  value="{{$user->id}}">
                                          <input type="text" class="form-control" disabled name='username' value="{{$user->username}}">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputPassword1" class="col-lg-2 control-label">角色名:</label>
                                      <div class="col-lg-10">
                                      @foreach($roles as $k=>$v)
                                          <label class="checkbox-inline">
                                            @if(in_array($v->id,$own_role))
                                              <input type="checkbox" id="inlineCheckbox1" name='role_id[]' checked value='{{$v->id}}'> {{$v->name}}
                                            @else
                                               <input type="checkbox" id="inlineCheckbox1" name='role_id[]' value='{{$v->id}}'> {{$v->name}}
                                            @endif
                                          </label>
                                      @endforeach
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