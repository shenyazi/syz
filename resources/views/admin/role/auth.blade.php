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
                          <li><a href="#">角色管理</a></li>
                          <li class="active">角色授权</li>
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
                             <b>授权角色的表单</b>
                          </header>

                          <div class="panel-body">
                              <form class="form-horizontal" role="form" id="art_form" action="{{url('role/doauth')}}" method='post' >
                                  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 control-label">角色名字:	</label>
                                      <div class="col-lg-6">
                                          <input type="hidden" name="role_id" value='{{$role->id}}'>
                                          <input type="text" class="form-control"  name='name' readonly value="{{$role->name}}">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputPassword1" class="col-lg-2 control-label">权限:</label>
                                      <div class="col-lg-10">
                                        @foreach($auths as $v)
                                          <label class="checkbox-inline">
                                            @if(in_array($v->id,$own_auth))
                                              <input type="checkbox" id="inlineCheckbox1" name='auth_id[]' checked value="{{$v->id}}">{{$v->name}}
                                            @else
                                               <input type="checkbox" id="inlineCheckbox1" name='auth_id[]' value="{{$v->id}}">{{$v->name}}
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