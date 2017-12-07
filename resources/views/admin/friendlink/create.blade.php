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
                          <li class="active">添加</li>
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
                             <b>添加友情链接的表单</b>
                          </header>

                          <div class="panel-body">
                              <form class="form-horizontal" role="form" id="art_form" action="{{url('friendlink')}}" method='post' enctype='multipart/form-data'>
                                  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 control-label">链接名字:	</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"  name='lname' value="{{old('lname')}}">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputPassword1" class="col-lg-2 control-label">链接地址:</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control"  name='lurl' value="{{old('lurl')}}">
                                      </div>
                                  </div>
                                   <div class="form-group">
                                      <label for="inputPassword1" class="col-lg-2 control-label">链接Logo:</label>
                                      <div class="col-lg-6">
                                          <input type="text" size="40" id="limg" name="limg" >
                                          <input id="file_upload" name="file_upload" type="file" multiple='true' >
                                          <img src="" id="img1" alt="" style="width:80px;height:80px">
                                           <script type="text/javascript">
                                              $(function () {
                                                  $("#file_upload").change(function () {
                                                      $('img1').show();
                                                      uploadImage();
                                                  });
                                              });
                                              function uploadImage() {
                                                  // 判断是否有选择上传文件
                                                  var imgPath = $("#file_upload").val();
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
                                                  var formData = new FormData($('#art_form')[0]);
                                                 // alert(formData);
                                                  // var formData = new FormData();
                                                  // formData.append('file_upload', $('#file_upload')[0].files[0]);
                                                  // formData.append('_token',"{{csrf_token()}}");
                                                  $.ajax({
                                                      type: "POST",
                                                      url: "/admin/upload",
                                                      data: formData,
                                                      async: true,
                                                      cache: false,
                                                      contentType: false,
                                                      processData: false,
                                                      success: function(data) {
                                                          // $('#img1').attr('src','/uploads/'+data);
                                                       //$('#img1').attr('src','http://p09v2gc7p.bkt.clouddn.com/uploads/'+data);
                                                         $('#img1').attr('src','http://php193.oss-cn-beijing.aliyuncs.com/'+data);
                                                          $('#img1').show();
                                                          $('#limg').val('/uploads/'+data);
                                                      },
                                                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                                                          alert("上传失败，请检查网络后重试");
                                                      }
                                                  });
                                              }
                                          </script>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputPassword1" class="col-lg-2 control-label">链接状态:</label>
                                      <div class="col-lg-6">
                                          <input type="radio" id="inputPassword1" name='status' value='1'>开启&nbsp;
                                          <input type="radio" id="inputPassword1" name='status' value='0'>关闭
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                      			{{csrf_field()}}
                                          <button type="submit" class="btn btn-danger">添 加</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                     
                  </div>
              </div>

            
              <!-- page end-->
          </section>
      </section>
@endsection