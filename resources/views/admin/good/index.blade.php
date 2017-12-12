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
               <form id="fm" action="{{url('admin/good')}}" method='get'>
              <!--  <div id="xs">
               <b >每页显示条数:</b>
               
                              <select id = "op" style="width:200px" name='num'>
                                    <option value='5'  @if($request['num'] == 5)  selected  @endif>5</option>
                                    <option value='10' @if($request['num'] == 10)  selected  @endif>10</option>
                                    <option value='20' @if($request['num'] == 20)  selected  @endif>20</option>
                                </select>
                </div> -->
            
     <table class="search_tab"  style='padding:12px;margin-left:300px'>
                              <tr>
                                  
                                  
                                  <th>关键字:</th>
                                  <td width="">
                                      <input type="text" name="gname" value="" placeholder="商品名称">
                                      <button class="btn btn-success">查 询</button>
                                  </td>
                                   
                              </tr>
                              </table>

   </form>  




                                                
                          <table   class="table table-striped table-advance table-hover">
                              <thead>
                              <tr>
                                  <th><i class="icon-bullhorn"></i>ID</th>
                                  <th class="hidden-phone"><i class="icon-question-sign"></i>商品名称</th>
                                  <th><i class="icon-bookmark"></i>商品价格</th>
                                  <th><i class=" icon-edit"></i>库存</th>
                                   <th><i class="icon-bookmark"></i>商品描述</th>
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
                                  <td class='award-name'>{{$v->goodDes}} </td>
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
                                  <td> 
                                  <a href="{{url('admin/good/'.$v->id.'/edit')}}" style='margin-right:3px;float:left'><button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button></a>
                                   <a href="javascript:;" onclick="del({{$v->id}})" style='margin-right:3px;float:left'><button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button></a>
                                   <a  href="{{url('/admin/good/zt/'.$v->id)}}" >
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
                                  {{ $goods->appends($request->all())->links() }}
                              </div>
                            
                             
                              
                    
                      </section>
                     
                  </div>
              </div>


            
              <!-- page end-->
          </section>
      </section>
       <script type="text/javascript">
          //链接删除调用的函数
                                  function del(id){
                                    layer.confirm('您确定要删除???', {
                                      btn: ['确定','取消'] 
                                    }, function(){
                                      //$.post("请求服务器的路径","携带的参数", 获取执行成功后的返回数据);
                                     
                                      $.post("{{url('/admin/good')}}/"+id,{"_method":'delete',"_token":"{{csrf_token()}}"},function(data){
                                        //删除成功
                                        if(data.error==0){
                                          layer.msg(data.msg, {icon: 6});
                                          var t=setTimeout("location.href = location.href;",3000);
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
