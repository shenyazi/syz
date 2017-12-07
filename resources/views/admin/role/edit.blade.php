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
                          <li class="active">角色修改</li>
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
                             <b>修改角色的表单</b>
                          </header>

                          <div class="panel-body">
                              <form class="form-horizontal" role="form" id="art_form" action="{{url('role/'.$role->id)}}" method='post' >
                                  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 control-label">角色名字: </label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"  name='name' value="{{$role->name}}">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputPassword1" class="col-lg-2 control-label">角色描述:</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"  name='desc' value="{{$role->desc}}">
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