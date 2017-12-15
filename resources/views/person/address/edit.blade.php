@extends('layouts.person')

@section('title')
    地址管理
@endsection

@section('css')
    <link href="/homes/css/addstyle.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
            <div class="user-address">
                <div class="clear"></div>
                <a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
                <!--例子-->
                <div class="am-modal am-modal-no-btn" id="doc-modal-1">

                    <div class="add-dress">

                        <!--标题 -->
                        <div class="am-cf am-padding">
                            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改收货地址</strong> / <small>Edit&nbsp;address</small></div>
                        </div>

                        <hr/>

                        <div class="am-u-md-12 am-u-lg-8 docs-methods" style="margin-top: 20px;">
                            <form class="am-form am-form-horizontal form-inline" action="{{url('person/address/'.$address->id)}}" method="post">

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

                                {{csrf_field()}}
                                {{method_field('put')}}
                                <div class="am-form-group">
                                    <label for="user-name" class="am-form-label" style="color:red;font-weight:bold;">原收货人</label>
                                    <div class="am-form-content">
                                        <input type="text" id="user-name" name="oldname" disabled value="{{$address->name}}" >
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-name" class="am-form-label" style="color:forestgreen;font-weight:bold;">新收货人</label>
                                    <div class="am-form-content">
                                        <input type="text" id="user-name" name="name" placeholder="请填写新收货人" value="{{old('name')}}">
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-phone" class="am-form-label" style="color:red;font-weight:bold;">原手机号码</label>
                                    <div class="am-form-content">
                                        <input id="user-phone" type="text" name="oldphone" value="{{$address->phone}}" disabled >
                                    </div>
                                </div>
                                    <input type="hidden" name="isStaAdd" value="{{$address->isStaAdd}}">

                                <div class="am-form-group">
                                    <label for="user-phone" class="am-form-label" style="color:forestgreen;font-weight:bold;">新手机号码</label>
                                    <div class="am-form-content">
                                        <input id="user-phone" type="text" name="phone" value="{{old('phone')}}" placeholder="请填写新手机号"  >
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-intro" class="am-form-label" style="color:red;font-weight:bold;">原收货地址</label>
                                    <div class="am-form-content">
                                        <textarea class="" rows="3" id="user-intro" disabled >{{$address->address}}</textarea>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-intro" class="am-form-label" style="color:forestgreen;font-weight:bold;">新收货地址</label>
                                    <div class="am-form-content">
                                        <textarea class="" rows="3" id="user-intro" name="address"  placeholder="请写出你的详细地址 省/市/区/详细地址">{{old('address')}}</textarea>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="submit" style="border: none;"><a class="am-btn am-btn-danger">保存</a></button>
                                        <a href="{{url('person/address')}}" class="am-close am-btn am-btn-danger" data-am-modal-close>取消</a>
                                    </div>
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
            </script>

            <div class="clear"></div>
@endsection