@extends('layouts.admin')

@section('title')
    后台用户列表页面
@endsection

@section('content')
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
             
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              用户列表
                          </header>

                              <ul>
                                  @if(session('msg'))
                                      <li style="color:red">{{session('msg')}}</li>
                                  @endif
                              </ul>
                          
                          <form action="/user" method='get'>
                          <table class="search_tab">
                              <tr>
                                 
                                  
                                  <th>关键字:</th>
                                  <td width="">
                                      <input type="text" name="username" value="{{$request->username}}" placeholder="用户名">
                                      <input type="submit"  value="查询">
                                  </td>
                                   
                              </tr>
                          </table>
                           
                          </form>

                          <table class="table table-striped table-advance table-hover">
                              <thead>
                              <tr>
                                  <th><i class="icon-bullhorn"></i> ID</th>
                                  <th class="hidden-phone"><i class="icon-question-sign"></i> 用户名</th>
                                  <th><i class="icon-bookmark"></i> 密码</th>
                                  <th><i class=" icon-edit"></i> 操作</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($user as $v)
                              <tr>
                                  <td><a href="#">{{$v->id}}</a></td>
                                  <td class="hidden-phone">{{$v->username}}</td>
                                  <td>{{$v->password}}</td>
                                  <td>
                                      <a href="{{url('user/auth/'.$v->id)}}">授权</a>
                                      <a href="{{url('user/'.$v->id.'/edit')}}">修改</a>
                                      <a href="javascript:;" onclick="userDel({{$v->id}})">删除</a>
                                  </td>
                              </tr>
                              @endforeach
                              </tbody>
                          </table>
                          <style>

                              table{table-layout: fixed;word-break: break-all; word-wrap: break-word;}
                                /*//超出部分显示省略号}*/
                              .award-name{-o-text-overflow:ellipsis;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;width:100%; 

                          </style>
                      </section>
                  </div>
              </div>
              <!-- page end-->
              <div class="page_list">
                    {!! $user->appends($request->all())->render() !!}
              </div>
              <style>
                    .page_list ul li span{
                        padding:6px 12px;
                        
                    }

              </style>
              <script>
                  function userDel(id){
                    layer.confirm('您确认删除吗？',{
                      btn:['确认','取消']
                    },function(){
                      $.post("{{url('user')}}/"+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){
                        if(data.error == 0){
                          layer.msg(data.msg,{icon:6});
                          var t=setTimeout("location.href = location.href;",1000);
                        }else{
                          layer.msg(data.msg,{icon:5});
                          var t=setTimeout("location.href = location.href;",1000);
                        }

                    });
                  });
                }
         
              </script>

          </section>
      </section>
      <!--main content end-->
  </section>
@endsection