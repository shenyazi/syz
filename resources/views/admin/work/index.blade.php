@extends('layouts.admin')

@section('title',$title)

@section('content')
	<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
              	<div class="col-lg-12">
                      <ul class="breadcrumb">
                          <li><a href="/admin"><i class="icon-home"></i> Home</a></li>
                          <li><a href="/work/create">文章模块</a></li>
                          <li class="active">列 表</li>
                      </ul>
                  </div>

                  <div class="col-lg-12">
                      @if (Session('success'))
                        <div class="alert alert-danger">
                          <ul>
                              <li style="color:green">{{ Session('success') }}</li>
                          </ul>
                        </div>
                      @endif
                      <section class="panel">
                          <header class="panel-heading">
                              <b>文章模块列表</b>
                          </header>
                          <form action="{{url('work')}}" method='get' style='padding:12px;margin-left:55px'>
                              <b >每页显示条数:</b>
                                <select name='num'>
                                    <option value='5'  @if($request['num'] == 5)  selected  @endif>5</option>
                                    <option value='10' @if($request['num'] == 10)  selected  @endif>10</option>
                                    <option value='20' @if($request['num'] == 20)  selected  @endif>20</option>
                                </select>
                              <b style='margin-left:50px'>文章标题:</b><input type="text" name="wtitle" value="{{$request->wtitle}}">
                              <button class="btn btn-primary btn-xm">查 询</button>
                          </form>  
                          
                          <style type="text/css">
                              .table{
                                  table-layout: fixed;word-break: break-all; word-wrap: break-word;
                              }
                              .award-name
                              {
                                -o-text-overflow:ellipsis;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;
                                /*height:100px; */
                              }
                          </style>
                          <table class="table table-striped table-advance table-hover">
                              <thead>
                              <tr>
                                  <th><i class="icon-bullhorn"></i>ID</th>
                                  <th class="hidden-phone"><i class="icon-question-sign"></i>文章标题</th>
                                  <th><i class="icon-bookmark"></i>文章描述</th>
                                  <!-- <th><i class=" icon-edit"></i>文章内容</th> -->
                                  <th>操作</th>
                              </tr>
                              </thead>
                              <tbody>
                            @foreach($works as $v)
                              <tr>
                                  <td>{{$v->id}}</td>
                                  <td>{{$v->wtitle}}</td>
                                  <td class='award-name'>{{$v->wdesc}} </td>
                                  <!-- <td>{!! $v->wcontent !!}</td> -->
                                  <td>
                                      <a href='/work/{{$v->id}}/edit' style='margin-right:3px;float:left'><button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button></a>
                                      <a href='javascript:;' onclick='del({{$v->id}})' style='margin-right:3px;float:left'><button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button></a>
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
                 {!! $works->appends($request->all())->render() !!}
              </div>
          </section>

          
          <script type="text/javascript">
            //删除文章调用的函数
            function del(id){
              layer.confirm('您确定要删除???', {
                btn: ['确定','取消'] 
              }, function(){
                //$.post("请求服务器的路径","携带的参数", 获取执行成功后的额返回数据);
                $.post("{{url('work')}}/"+id,{"_method":'delete',"_token":"{{csrf_token()}}"},function(data){
                  //删除成功
                  if(data.error==0){
                    layer.msg(data.msg, {icon: 6});
                    var t=setTimeout("location.href = location.href;",2500);
                  }else{
                    layer.msg(data.msg, {icon: 5});
                    var t=setTimeout("location.href = location.href;",3000);
                  }
                });
                
              }, function(){
                
              });
            }
          </script>
      </section>
@endsection