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
                          <li><a href="#"></a></li>
                          <li class="active"></li>
                      </ul>
                  </div>
              </div>
               @if (Session('success'))
                        <div class="alert alert-danger">
                          <ul>
                              <li style="color:blue">{{ Session('success') }}</li>
                          </ul>
                        </div>
               @endif
                <section class="panel">
                          <header class="panel-heading">
                              <b>商品列表</b>
                          </header>
               <form  action="{{url('friendlink')}}" method='get' style='padding:12px;margin-left:300px'>
                             
                             <input type="text" name="lname" value="">
                              <button class="btn btn-primary btn-xm">查 询</button>
                          </form>  
                         
                          <table   class="table table-striped table-advance table-hover">
                              <thead>
                              <tr>
                                  <th><i class="icon-bullhorn"></i>ID</th>
                                  <th class="hidden-phone"><i class="icon-question-sign"></i>商品名称</th>
                                  <th><i class="icon-bookmark"></i>商品价格</th>
                                  <th><i class=" icon-edit"></i>库存</th>
                                  <th><i class=" icon-edit"></i>商品图片</th>
                                  <th><i class=" icon-edit"></i>商品状态</th>
                                  <th>操作</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($goods as $k=>$v)
                              <tr>
                                  <td>{{$v->id}}</td>
                                  <td>{{$v->gname}}</td>
                                  <td>{{$v->gprice}}</td>
                                  <td>{{$v->goodsNum}}</td>
                                  @if($v->gpic)
                                  <td><img style = "width:100px;height:50px;" src="{{$v->gpic}}"> </td>
                                  @else
                                  <td style = "width:100px;height:50px;">该商品没有上传图片</td>
                                  @endif
                                  <td> 
                                  <div @if($v->gstatus == 1) class="label label-warning label-mini" @elseif($v->gstatus == 2) class="label label-danger label-mini" @elseif($v->gstatus==3) class="label label-primary label-mini" @endif>
                                  @if($v->gstatus == 1) 新品@elseif($v->gstatus == 2)上架@elseif($v->gstatus == 3)下架@endif
                                  </div>
                                  </td>
                                  <td> <a href="{{url('friendlink/'.$v->id.'/edit')}}" style='margin-right:3px;float:left'><button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button></a>
                                   <a href="javascript:;" onclick="del({{$v->id}})" style='margin-right:3px;float:left'><button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button></a>
                                   <a  href="" >
                                  <div @if($v->gstatus == 1 || $v->gstatus == 3)class="label label-danger label-mini " @else($v->gstatus==2) class="label label-primary label-mini" @endif>
                                   @if($v->gstatus == 1 || $v->gstatus == 3) 上架@else 下架 @endif
                                  </div>
                                  </a>
                                   </td>

                              </tr>
                              
                              @endforeach

                              </tbody>
                              </table>
                              <div style="text-align: center">
                                  {{ $goods->links() }}
                              </div>
                              
                             
                              
                    
                      </section>
                     
                  </div>
              </div>


            
              <!-- page end-->
          </section>
      </section>
@endsection
