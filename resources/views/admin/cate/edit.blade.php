@extends('layouts.admin')

@section('title')
    后台类别修改页面
@endsection

@section('content')
    <section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            类别修改
                        </header>
                        <div class="panel-body">
                            <form role="form" action="{{url('admin/cate/'.$cate->cate_id)}}" method="post">

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

                                <div class="form-group" style="margin-bottom: 30px;">
                                    {{csrf_field()}}
                                    {{method_field('put')}}
                                    <label for="exampleInputEmail1" style="margin-bottom: 15px;color:#EC6459;font-weight:bold;">原分类名称</label>
                                    <input type="text" disabled style="width:400px;" class="form-control" name="old" value="{{$cate -> cate_name}}" placeholder="填写分类">
                                    <label for="exampleInputEmail1" style="margin-bottom: 15px;padding-top:30px;color:#78CD51;font-weight:bold;">新分类名称</label>
                                    <input type="text"  style="width:400px;" class="form-control" name="cate_name" value="" placeholder="填写新分类">
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