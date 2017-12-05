@extends('layouts.admin')

@section('title')
    后台类别添加页面
@endsection

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            类别添加
                        </header>
                        <div class="panel-body">
                            <form role="form" action="{{url('admin/cate')}}" method="post">

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @if(is_object($errors))
                                                @foreach ($errors->all() as $error)
                                                    <li style="color:red">{{ $error }}</li>
                                                @endforeach
                                            @else
                                                <li style="color:red">{{ $errors }}</li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif

                                <div class="btn-group" style="margin-bottom:20px;">
                                    {{csrf_field()}}

                                    <select name="cate_pid" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
                                        <option value="0"  >==顶级分类==</option>
                                        @foreach($cateOne as $k=>$v)
                                        @if($v->cate_id == old('cate_pid'))
                                            <option value="{{$v->cate_id}}" selected >{{$v->cate_name}}</option>
                                        @else
                                            <option value="{{$v->cate_id}}"  >{{$v->cate_name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">分类名称</label>
                                    <input type="text" style="width:300px;" class="form-control" name="cate_name" value="{{old('cate_name')}}" placeholder="填写分类">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">排序</label>
                                    <input type="text" style="width:300px;" class="form-control" name="cate_order" value="{{old('cate_order')}}" placeholder="填写排序">
                                </div>
                                <button type="submit" class="btn btn-info" style="margin-right: 5px;">提交</button>
                                    <button type="text" class="btn btn-info" ><a href="{{url('admin/cate')}}" style="color:white;">返回</a></button>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
@endsection