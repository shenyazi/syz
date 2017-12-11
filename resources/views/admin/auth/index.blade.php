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
                          <li><a href="#">权限管理</a></li>
                          <li class="active">列 表</li>
                      </ul>
                  </div>

                  <div class="col-lg-12">
                      @if (Session('msg'))
                        <div class="alert alert-danger">
                          <ul>
                              <li style="color:red">{{ Session('msg') }}</li>
                          </ul>
                        </div>
                      @endif
                      <section class="panel">
                          <header class="panel-heading">
                              <b>角色列表</b>
                          </header>
                          <form action="{{url('auth')}}" method='get' style='padding:12px;margin-left:55px'>
                              <b >每页显示条数:</b>
                                <select name='num'>
                                    <option value='5'  @if($request['num'] == 5)  selected  @endif>5</option>
                                    <option value='10' @if($request['num'] == 10)  selected  @endif>10</option>
                                    <option value='20' @if($request['num'] == 20)  selected  @endif>20</option>
                                </select>
                              <b style='margin-left:50px'>权限名:</b><input type="text" name="name" value="{{$request->name}}">
                              <button class="btn btn-primary btn-xm">查 询</button>
                          </form>  
                          <table class="table table-striped table-advance table-hover">
                              <thead>
                              <tr>
                                  <th><i class="icon-bullhorn"></i>ID</th>
                                  <th class="hidden-phone"><i class="icon-question-sign"></i>权限名</th>
                                  <th><i class="icon-bookmark"></i>权限描述</th>
                                  <th>操作</th>
                              </tr>
                              </thead>
                              <tbody>
                            @foreach($auths as $v)
                              <tr>
                                  <td>{{$v->id}}</td>
                                  <td class="hidden-phone">{{$v->name}}</td>
                                  <td>{{$v->desc}} </td>
                                  <td>
                                      <a href="{{url('auth/'.$v->id.'/edit')}}" style='margin-right:3px;margin-left:5px;float:left'><button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button></a>
                                      <a href="javascript:;" onclick="del({{$v->id}})" style='margin-right:3px;float:left'><button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button></a>
                                  </td>
                              </tr>
                            @endforeach
                              </tbody>
                          </table>
                      </section>
                  </div>
              </div>
              <!-- page end-->
             
             <!-- 分页列表 -->
              <div class="dataTables_paginate paging_bootstrap pagination">
                 {!! $auths->appends($request->all())->render() !!}
              </div>
          </section>
      </section>

     <script type="text/javascript">
          //链接删除调用的函数
          function del(id){
            layer.confirm('您确定要删除???', {
              btn: ['确定','取消'] 
            }, function(){
              //$.post("请求服务器的路径","携带的参数", 获取执行成功后的额返回数据);
              $.post("{{url('auth')}}/"+id,{"_method":'delete',"_token":"{{csrf_token()}}"},function(data){
                //删除成功
                if(data.error==0){
                  layer.msg(data.msg, {icon: 6});
                  var t=setTimeout("location.href = location.href;",2000);
                }else{
                  layer.msg(data.msg, {icon: 5});
                  var t=setTimeout("location.href = location.href;",3000);
                }
              });
              
            }, function(){
              
            });
          }
      </script>
@endsection