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
                              <b>友情链接列表</b>
                          </header>
                          <form action="{{url('friendlink')}}" method='get' style='padding:12px;margin-left:55px'>
                              <b >每页显示条数:</b>
                                <select name='num'>
                                    <option value='5'  @if($request['num'] == 5)  selected  @endif>5</option>
                                    <option value='10' @if($request['num'] == 10)  selected  @endif>10</option>
                                    <option value='20' @if($request['num'] == 20)  selected  @endif>20</option>
                                </select>
                              <b style='margin-left:50px'>链接名:</b><input type="text" name="lname" value="{{$request->lname}}">
                              <button class="btn btn-primary btn-xm">查 询</button>
                          </form>  
                          <table class="table table-striped table-advance table-hover">
                              <thead>
                              <tr>
                                  <th><i class="icon-bullhorn"></i>ID</th>
                                  <th class="hidden-phone"><i class="icon-question-sign"></i>链接名称</th>
                                  <th><i class="icon-bookmark"></i>链接地址</th>
                                  <th><i class=" icon-edit"></i>链接状态</th>
                                  <th><i class=" icon-edit"></i>链接图片</th>
                                  <th>操作</th>
                              </tr>
                              </thead>
                              <tbody>
                            @foreach($friends as $v)
                              <tr>
                                  <td>{{$v->id}}</td>
                                  <td class="hidden-phone">{{$v->lname}}</td>
                                  <td>{{$v->lurl}} </td>
                                  <td>
                                      @if($v->status ==1)  开启
                                      @else   关闭
                                      @endif 
                                  </td>
                                  <td>{{$v->limg}}</td>
                                  <td>
                                      <a href='/friendlink/{{$v->id}}/edit' style='margin-right:3px;float:left'><button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button></a>
                                      <form action='/friendlink/{{$v->id}}' method='post' style='float:left'>
                                          <input type="hidden" name="_method" value='delete'>
                                            {{csrf_field()}}
                                          <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                      </form>
                                     
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
                 {!! $friends->appends($request->all())->render() !!}
              </div>
          </section>
      </section>
@endsection