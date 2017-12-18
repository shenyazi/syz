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
                          <li class="active">修 改</li>
                      </ul>
                  </div>
              </div>
              <div class="row">
                 	@if (count($errors) > 0)
      						<div class="alert alert-danger">
      							<ul>
      								@foreach ($errors->all() as $error)
      									<li style="color:red">{{ $error }}</li>
      								@endforeach
      							</ul>
      						</div>
      					@endif
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             <b>修改商品</b>        
                          </header>

                         <form action="{{url('admin/good/'.$good->id)}}" method="post" id="bd" enctype='multipart/form-data'>

                           
                           
                          <table class="table table-bordered">
                              
                              <tr >
                                  <th>分类:</th>
                                  
                                  <td>
                                        
                                      <select class="form-control" id="inputPassword2" name='pid'  ">  
                                           @foreach($cates as $k=>$v)
                                            @if(in_array($v->cate_id,$cate))
                                              <option disabled="disabled" @if($v->cate_id == $good->pid) selected @endif value="{{$v->cate_id}}">{{$v->_cate_name}}</option>  
                                            @else if
                                            <option  @if($v->cate_id == $good->pid) selected @endif value="{{$v->cate_id}}" >{{$v->_cate_name}}</option>  
                                            @endif
                                          @endforeach
                                       </select>  

                                  </td>
                                 
                              </tr>
                              <tr>
                                  <th>商品名称:</th>
                                  <td>

                                      <input class="form-control " id="inputPassword3" type="text" name="gname" value="{{$good->gname}}" placeholder="请输入您想要的商品名称">
                                     
                                  </td>
                              </tr>
                              <tr>
                                  <th>商品价格:</th>
                                  <td>
                                      <input class="form-control" id="inputPassword2" type="text" name="gprice" value="{{$good->gprice}}" placeholder="请输入您想要的价格">
                                  </td>
                              </tr>
                              <tr>
                                  <th>库存:</th>
                                  <td>
                                   
                                      <input class="form-control" id="inputPassword2" type="text" name="goodsNum" value = "{{$good->goodsNum}}"placeholder="请填写您的商品数量">
                                  </td>
                              </tr>
                              {{csrf_field()}}
                              <tr>
                                  <th>商品图片:</th>
                                  <td>
                                  <input type="text" size="40" id="limg" value ="{{$good->gpic}}"  name="gpic" >
                                      <input  id="tp" type="file" name="gpicc" 
                                      multiple='true'>
                                      <img src="{{$good->gpic}}" id="img1" alt="" style="width:80px;height:80px">
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
                                                      return;
                                                  }
                                                 
                                                 var formData = new FormData();
                                                 formData.append("gpficc", $('#tp')[0].files[0]);
                                                formData.append("_token", '{{csrf_token()}}');


                                                
                                                  $.ajax({
                                                      type: "POST",
                                                      url: "/admin/uploadd",
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
                                                          $('#limg').val('/uploads/'+data);
                                                      },
                                                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                                                          alert("上传失败，请检查网络后重试");
                                                      }
                                                  });
                                              }
                                      </script>
                                  </td>
                              </tr>
                               <tr>
                                  <th>商品描述:</th>
                                  <td>
<!--                                       <textarea class="form-control" id="inputPassword2" name="goodsDes" placeholder="请对您的商品进行描述"></textarea> -->
                                       <div class="form-group">
                                      
                                      <div class="col-lg-6">
                                          <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
                                          <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
                                          <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>

                                          <script id="editor" name="goodsDes" type="text/plain" style="width:800px;height:300px;">{!! $good->goodsDes !!}</script>
                                          <script>
                                              var ue = UE.getEditor('editor');
                                          </script>
                                          <style>
                                              .edui-default{line-height: 28px;}
                                              div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                                              {overflow: hidden; height:20px;}
                                              div.edui-box{overflow: hidden; height:22px;}
                                          </style>
                                      </div>
                                  </div>
                                  </td>
                              </tr>
                               <tr>
                                  <th>状态:</th>
                                  <td>
                                      <input type="radio" name="gstatus" @if($good->gstatus == '1') checked @endif value="1" checked>新品
                                      <input type="radio" name="gstatus"  @if($good->gstatus == '2') checked @endif value="2">上架
                                      <input type="radio" @if($good->gstatus == '3') checked @endif  name="gstatus" value="3">下架
                                  </td>
                              </tr>
                              <tr>
                                  <th></th>
                                  <td>
                                      {{csrf_field()}}
                                          <input type="hidden" name="_method" value='put'>
                                          <button type="submit" class="btn btn-danger">更新</button>
                                  </td>
                              </tr>
                             
                              
                          </table>
                      </section>
                  </div>
                  </form>
                      </section>
                     
                  </div>
              </div>

            
              <!-- page end-->
          </section>
      </section>
@endsection