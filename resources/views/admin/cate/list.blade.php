@extends('layouts.admin')

@section('title')
    后台类别管理页面
@endsection

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-sm-12">
                    @if(session('msg'))
                    <div class="alert alert-success alert-block fade in" style="width:150px;">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                            <i class="icon-remove"></i>
                        </button>
                            <h4>
                                <i class="icon-ok-sign"></i>
                                {{session('msg')}}
                            </h4>

                    </div>
                    @endif
                    <section class="panel">
                        <header class="panel-heading">
                            类别浏览
                        </header>
                    <form action="#" method="post">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="tc" width="5%">排序</th>
                                <th class="tc" width="5%">ID</th>
                                <th>分类名称</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cates as $k=>$v)
                                <tr>
                                    <td  class="tc">
                                        <input id="exampleInputEmail2" style="width:45px;text-align:center;" class="form-control" type="text" onchange="changeOrder(this,{{$v->cate_id}})" value="{{$v->cate_order}}">
                                    </td>
                                    <td class="tc" style="vertical-align: middle;">{{$v->cate_id}}</td>
                                    <td style="vertical-align: middle;">
                                        <a href="#">{{$v->cate_names}}</a>
                                    </td>
                                    <td>
                                        <a href="{{url('admin/cate/'.$v->cate_id.'/edit')}}" class="btn btn-primary" data-toggle="modal">修改</a>
                                        <a href="javascript:;" class="btn btn-danger" data-toggle="modal" onclick="cateDel({{$v->cate_id}})">删除</a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </form>

                    <script>
                        // 排序
                        function changeOrder(obj, cate_id){
                            // 获取当前需要排序的记录的ID, cate_id

                            // 获取当前记录的排序文本框中的值
                            var cate_order = $(obj).val();
                            $.post("{{url("admin/cate/changeorder")}}",{'_token':"{{csrf_token()}}","cate_id":cate_id,"cate_order":cate_order}, function(data){
                                // 如果排序成功, 提示排序成功
                                if(data.status == 0){
                                    layer.msg(data.msg, {icon: 6});
                                    var t=setTimeout("location.href = location.href;",2000);
                                }else{
                                    // 如果排序失败, 提示排序失败
                                    layer.msg(data.msg, {icon: 5});
                                    var t=setTimeout("location.href = location.href;",2000);
                                }
                            })
                        }

                        function cateDel(id) {

                            //询问框
                            layer.confirm('您确认删除吗？', {
                                btn: ['确认','取消'] //按钮
                            }, function(){
//                如果用户发出删除请求，应该使用ajax向服务器发送删除请求
//                $.get("请求服务器的路径","携带的参数", 获取执行成功后的额返回数据);
                                //admin/user/1
                                $.post("{{url('admin/cate')}}/"+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){
                                    console.log(data);
//                    data是json格式的字符串，在js中如何将一个json字符串变成json对象
                                    //var res =  JSON.parse(data);
//                    删除成功
                                    if(data.error == 0){
                                        layer.msg(data.msg, {icon: 6});
                                        var t=setTimeout("location.href = location.href;",2000);
                                    }else if(data.error == 1){
//                                        alert(data.error);
                                        layer.msg(data.msg, {icon: 5});

                                        var t=setTimeout("location.href = location.href;",2000);
                                    }else{
                                        layer.msg(data.msg, {icon: 5});
                                        var t=setTimeout("location.href = location.href;",2000);
                                    }
                                });

                            }, function(){

                            });
                         }

                    </script>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
@endsection