@extends('layouts.person')

@section('title')
    地址管理
@endsection

@section('css')
    <link href="{{url('/homes/css/addstyle.css')}}" rel="stylesheet" type="text/css">

    <link href="http://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="{{url('css/city-picker.css')}}" rel="stylesheet" type="text/css" />

    <script src="{{url('js/jquery.js')}}"></script>
    <script src="{{url('js/bootstrap.js')}}"></script>
    <script src="{{url('js/city-picker.data.js')}}"></script>
    <script src="{{url('js/city-picker.js')}}"></script>
    <script src="{{url('js/main.js')}}"></script>

@endsection

@section('content')
            <div class="user-address">
                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
                </div>
                <hr/>
                <ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">

                    @foreach($address as $k => $v)
                        @if($v->isStaAdd == 1)
                        <li class="user-addresslist defaultAddr">
                        <span class="new-option-r"><i class="am-icon-check-circle"></i>默认地址</span>
                        @else
                        <li class="user-addresslist">
                            <form action="{{url('person/address/'.$v->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('put')}}
                                <input type="hidden" name="isStaAdd"  value="2" >
                                <span class="new-option-r"><button type="submit" style="border: none;background-color:#F974BA;"><i class="am-icon-check-circle"></i>设为默认</button></span>

                            </form>
                        @endif

                        <p class="new-tit new-p-re">
                            <span class="new-txt">{{$v->name}}</span>
                            <span class="new-txt-rd2">{{$v->phone}}</span>
                        </p>
                        <div class="new-mu_l2a new-p-re" style="height:69px;">
                            <p class="new-mu_l2cw">
                                <span class="title">地址：{{$v->address}}</span>
                        </div>
                        <div class="new-addr-btn">
                            <a href="{{url('person/address/'.$v->id.'/edit')}}"><i class="am-icon-edit"></i>编辑</a>
                            <span class="new-addr-bar">|</span>
                            <a href="javascript:void(0);" onclick="delClick(this);"><a onclick="addressDel({{$v->id}})" style="color:black;cursor:pointer;" ><i class="am-icon-trash"></i>删除</a></a>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <div class="clear"></div>
                <a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
                <!--例子-->
                <div class="am-modal am-modal-no-btn" id="doc-modal-1">

                    <div class="add-dress">

                        <!--标题 -->
                        <div class="am-cf am-padding">
                            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add&nbsp;address</small></div>
                        </div>
                        <hr/>

                        <div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
                            <form class="am-form am-form-horizontal" action="{{url('person/address')}}" method="post" >

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

                                <input type="hidden" name="uid" value="1" >
                                {{csrf_field()}}
                                <div class="am-form-group" style="padding-bottom: 20px;">
                                    <label for="user-name" class="am-form-label" style="font-weight:bold;">收货人</label>
                                    <div class="am-form-content">
                                        <input type="text" name="name" value="{{old('name')}}" id="user-name" placeholder="收货人">
                                    </div>
                                </div>

                                <div class="am-form-group" style="padding-bottom: 20px;">
                                    <label for="user-phone" class="am-form-label"  style="font-weight:bold;">手机号码</label>
                                    <div class="am-form-content">
                                        <input id="user-phone" name="phone" value="{{old('phone')}}" placeholder="手机号必填" type="text">
                                    </div>
                                </div>

                                    <div class="am-form-group" style="padding-bottom: 20px;">
                                        <label for="user-intro" class="am-form-label" style="font-weight:bold;">所在地区</label>

                                        <div class="am-form-content">
                                            <div style="position: relative;width:330px;float:left;display:block;">
                                                <input id="city-picker3" class="form-control" readonly name="address1" type="text" placeholder="&nbsp;&nbsp;请选择 省份 / 城市 / 区县" value="{{old('address1')}}"  data-toggle="city-picker" style="width:330px;">
                                            </div>
                                            <button class="btn btn-warning" id="reset" type="button" style="float:left;">重置</button>
                                            <button class="btn btn-danger" id="destroy" type="button" style="float:left;">确定</button>
                                        </div>

                                    </div>

                                    <div class="am-form-group" style="padding-bottom: 20px;">
                                        <label for="user-intro" class="am-form-label">详细地址</label>
                                        <div class="am-form-content">
                                            <textarea class="" rows="4" name="address2" id="user-intro" placeholder="请输入 街道 / 详细住址">{{old('address2')}}</textarea>
                                        </div>
                                    </div>



                                <div class="am-form-group" style="padding-bottom: 20px;">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="submit" style="border: none;"><a class="am-btn am-btn-danger">保存</a></button>
                                        <input type="reset" class="am-close am-btn am-btn-danger" value="取消" >
                                    </div>
                                </div>

                                <div class="am-form-group" style="padding-bottom: 20px;">
                                    <img src="{{url('images/广告图.jpg')}}" >
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>

            <script type="text/javascript">
                $(document).ready(function() {
                    $(".new-option-r").click(function() {
                        $(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
                    });

                    var $ww = $(window).width();
                    if($ww>640) {
                        $("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
                    }

                })



                function addressDel(id) {

                    //询问框
                    layer.confirm('您确认删除吗？', {
                        btn: ['确认','取消'] //按钮
                    }, function(){
//                如果用户发出删除请求，应该使用ajax向服务器发送删除请求
//                $.get("请求服务器的路径","携带的参数", 获取执行成功后的额返回数据);
                        //admin/user/1
                        $.post("{{url('person/address')}}/"+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){
                            console.log(data);
//                    data是json格式的字符串，在js中如何将一个json字符串变成json对象
                            //var res =  JSON.parse(data);
//                    删除成功
                            if(data.error == 0){
                                layer.msg(data.msg, {icon: 6});
                                var t=setTimeout("location.href = location.href;",2000);
                            }else{
//                                        alert(data.error);
                                layer.msg(data.msg, {icon: 5});

                                var t=setTimeout("location.href = location.href;",2000);
                            }
                        });

                    }, function(){

                    });
                }

            </script>

            <div class="clear"></div>
@endsection