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
                          <li><a href="#">订单管理</a></li>
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
                              <b>订单列表</b>
                          </header>
                          <form action="{{url('order')}}" method='get' style='padding:12px;margin-left:55px'>
                              <b >每页显示条数:</b>
                                <select name='num'>
                                   <option value='5'  @if($request['num'] == 5)  selected  @endif>5</option>
                                    <option value='10' @if($request['num'] == 10)  selected  @endif>10</option>
                                    <option value='20' @if($request['num'] == 20)  selected  @endif>20</option>
                                </select>
                              <b style='margin-left:50px'>链接名:</b><input type="text" name="gname" value="{{$request->gname}}">
                              <button class="btn btn-primary btn-xm">查 询</button>
                          </form>  
                          <table class="table table-striped table-advance table-hover">
                              <thead>
                              <tr>
                                  <th><i class="icon-bullhorn"></i>ID</th>
                                  <th class="hidden-phone"><i class="icon-question-sign"></i>订单号</th>
                                  <th><i class="icon-bookmark"></i>商品图片</th>
                                  <th><i class=" icon-edit"></i>商品名</th>
                                  <th><i class=" icon-edit"></i>商品总价</th>
                                  <th><i class=" icon-edit"></i>订单状态</th>
                                  <th>操作</th>
                              </tr>
                              </thead>
                              <tbody>
                            @foreach($orders as $v)
                              <tr>
                                  <td>{{$v->id}}</td>
                                  <td>{{$v->oid}}</td>
                                  <td class="hidden-phone"><img src="{{$v->gpic}}" width='100'></td>
                                  <td>{{$v->gname}} </td>
                                  <td>{{$v->gprice * $v->bcnt}}</td>
                                  <td>@if($v->status==0) <button class="btn btn-primary btn-xs">未发货</button>
                                      @elseif($v->status==1) <button class="btn btn-primary btn-xs">未收货</button>
                                      @elseif($v->status==2) <button class="btn btn-danger btn-xs">已收货</button>
                                      @endif
                                  </td>
                                  <td>
                                      <a href="{{url('order/'.$v->id.'/edit')}}" style='margin-right:3px;float:left'><button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button></a>
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
                {!! $orders->appends($request->all())->render() !!}
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
              $.post("{{url('order')}}/"+id,{"_method":'delete',"_token":"{{csrf_token()}}"},function(data){
                //删除成功
                if(data.error==0){
                  layer.msg(data.msg, {icon: 6});
                  var t=setTimeout("location.href = location.href;",2000);
                }else{
                  layer.msg(data.msg, {icon: 5});
                  var t=setTimeout("location.href = location.href;",2500);
                }
              });
              
            }, function(){
              
            });
          }
      </script>
@endsection