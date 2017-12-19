@extends('layouts.person')

@section('title')
    个人资料
@endsection

@section('css')
    <link href="{{url('/homes/css/infstyle.css')}}" rel="stylesheet" type="text/css">
    <script src="{{url('/homes/js/datePicker.js')}}"></script>


@endsection

@section('content')
            <div class="user-info">
                <!--标题 -->
                <div class="am-cf am-padding">
                    <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
                </div>
                <hr/>

                <!--头像 -->


                {{--<input type="text" size="40" id="limg" name="face" >--}}
                {{--<input  id="tp" type="file" name="facee" multiple='true'>--}}
                {{--<img src="" id="img1" alt="" style="width:80px;height:80px">--}}

                <script type="text/javascript">

                    $(function () {
                        $("#tp").change(function () {

                            $('img1').show();
                            uploadImage();

                        });
                    });
                    function uploadImage() {
                        // 判断是否有选择上传文件
                        var imgPath = $("#tp").val();
                        if (imgPath == "") {
                            alert("请选择上传图片！");
                            return;
                        }
                        //判断上传文件的后缀名
                        var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                        if (strExtension != 'jpg' && strExtension != 'gif'
                            && strExtension != 'png' && strExtension != 'bmp') {
                            alert("请选择图片文件");
                        }

                     var formData = new FormData($('#bd')[0]);
                        var formData = new FormData();
                        formData.append("facee", $('#tp')[0].files[0]);
                        formData.append("_token", '{{csrf_token()}}');


                        $.ajax({
                            type: "POST",
                            url: "/person/upload",
                            data: formData,
                            async: true,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                // $('#img1').attr('src','/uploads/'+data);
                                //$('#img1').attr('src','http://p09v2gc7p.bkt.clouddn.com/uploads/'+data);
                                $('#img1').attr('src','/uploads/'+data);
                                $('#img1').show();
                                $('#limg').attr('value','/uploads/'+data);
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                alert("上传失败，请检查网络后重试");
                            }
                        });
                    }
                </script>


                <!--个人信息 -->
                <div class="info-main">
                    <form class="am-form am-form-horizontal" id="bd" action="{{url('person/information/'.$info->id)}}" method="post">

                        <input type='hidden' id="limg" name="face" value="{{$info->face}}">

                        <div class="user-infoPic">

                            {{csrf_field()}}
                            {{method_field('put')}}
                            <div class="filePic">

                                <input type="file" class="inputPic" id="tp" name="facee" multiple='true' allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
                                <img src="{{$info->face}}" id="img1" alt="" style="width:90px;height:90px;border-radius:50%; overflow:hidden;padding:3px;box-shadow: 0px 0px 0px 4px white,0px 0px 0px 5px gray;">
                            </div>



                            <p class="am-form-help">头像</p>

                            <div class="info-m">
                                <div><b>用户名：<i>{{$info->nickname}}</i></b></div>
                                <div class="u-level">
									<span class="rank r2">
							             <s class="vip1"></s>铜牌会员
						            </span>
                                </div>
                                <div class="u-safety">
                                        账户安全
                                        <span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">60分</i></span>
                                </div>
                            </div>
                        </div>



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

                        <div class="am-form-group">
                            <label for="user-name2" class="am-form-label">昵称</label>
                            <div class="am-form-content">
                                <input type="text" id="user-name2" name="nickname" placeholder="nickname" value="{{$info->nickname}}">

                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-name" class="am-form-label">姓名</label>
                            <div class="am-form-content">
                                <input type="text" id="user-name2" name="realname" placeholder="name" value="{{$info->realname}}">

                            </div>
                        </div>

                        <div class="am-form-group">
                            <label class="am-form-label">性别</label>
                            <div class="am-form-content sex">
                                <label class="am-radio-inline">
                                    <input type="radio" name="sex" value="1" @if($info->sex == 1) checked @endif data-am-ucheck> 男
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="sex" value="0" @if($info->sex == 0) checked @endif data-am-ucheck> 女
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="sex" value="2" @if($info->sex == 2) checked @endif data-am-ucheck> 保密
                                </label>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-birth" class="am-form-label" >生日</label>
                            <div class="am-form-content birth" style="padding-top:10px;">

                                <input id="demo1" placeholder="请点击选择日期" name="birthday" value="{{$info->birthday}}" style="width:575px; height:32px;background-color: #F5F8FA;border:1px solid #E4EAEE;text-indent:1em;">
                                <script>
                                    var calendar = new datePicker();
                                    calendar.init({
                                        'trigger': '#demo1', /*按钮选择器，用于触发弹出插件*/
                                        'type': 'date',/*模式：date日期；datetime日期时间；time时间；ym年月；*/
                                        'minDate':'1900-1-1',/*最小日期*/
                                        'maxDate':'2100-12-31',/*最大日期*/
                                        'onSubmit':function(){/*确认时触发事件*/
                                            var theSelectData=calendar.value;
                                        },
                                        'onClose':function(){/*取消时触发事件*/
                                        }
                                    });

                                </script>
                            </div>


                        </div>
                        <div class="am-form-group address">
                            <label for="user-address" class="am-form-label">收货地址</label>
                            <div class="am-form-content address">
                                <a href="address.html">
                                    <p class="new-mu_l2cw">
                                        <span class="province">湖北</span>省
                                        <span class="city">武汉</span>市
                                        <span class="dist">洪山</span>区
                                        <span class="street">雄楚大道666号(中南财经政法大学)</span>
                                        <span class="am-icon-angle-right"></span>
                                    </p>
                                </a>

                            </div>
                        </div>
                        <div class="am-form-group safety">
                            <label for="user-safety" class="am-form-label">账号安全</label>
                            <div class="am-form-content safety">
                                <a href="safety.html">

                                    <span class="am-icon-angle-right"></span>

                                </a>

                            </div>
                        </div>
                        <div class="info-btn">
                            <button type="submit" style="border: none;"><div class="am-btn am-btn-danger">保存修改</div></button>
                        </div>

                    </form>
                </div>

            </div>
@endsection