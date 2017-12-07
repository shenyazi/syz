@extends('layouts.admin')

@section('title',$title)

@section('content')
  
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              
              <style type="text/css">
                  th{
                      text-align:center;
                      vertical-align:middle


                  }

              </style>
              <div class="row ">
                  <div class="col-sm-12">
                      <section class="panel">
                          <header class="panel-heading no-border">
                              添加商品
                          </header>
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
                          <form action="{{url('admin/good')}}" method="post" id="bd" enctype='multipart/form-data'>

                           
                           
                          <table class="table table-bordered">
                              
                              <tr >
                                  <th>分类:</th>
                                  
                                  <td>
                                        
                                      <select class="form-control" id="inputPassword2" name='pid'  ">  
                                           @foreach($cates as $k=>$v)
                                        <option value="{{$v->cate_pid}}" >{{$v->cate_name}}</option>  
                                          @endforeach
                                       </select>  

                                  </td>
                                 
                              </tr>
                              <tr>
                                  <th>商品名称:</th>
                                  <td>

                                      <input class="form-control " id="inputPassword3" type="text" name="gname" placeholder="请填写您的商品名称">
                                     
                                  </td>
                              </tr>
                              <tr>
                                  <th>商品价格:</th>
                                  <td>
                                      <input class="form-control" id="inputPassword2" type="text" name="gprice" placeholder="请标明您的价格">
                                  </td>
                              </tr>
                              <tr>
                                  <th>库存:</th>
                                  <td>
                                   
                                      <input class="form-control" id="inputPassword2" type="text" name="goodsNum" placeholder="请填写您的商品数量">
                                  </td>
                              </tr>
                              {{csrf_field()}}
                              <tr>
                                  <th>商品图片:</th>
                                  <td>
                                  <input type="text" size="40" id="limg" name="gpic" >
                                      <input  id="tp" type="file" name="gpicc" 
                                      multiple='true'>
                                      <img src="" id="img1" alt="" style="width:80px;height:80px">
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
                                                 
                                                 var formData = new FormData($('#bd')[0]);
                                                
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
                                        <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
                                          <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
                                          <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>

                                          <script id="editor" name="goodsDes" type="text/plain" style="width:600px;height:30px;"></script>
                                          <script>
                                              var ue = UE.getEditor('editor');
                                          </script>
                                          <style>
                                              .edui-default{line-height: 28px;}
                                              div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                                              {overflow: hidden; height:20px;}
                                              div.edui-box{overflow: hidden; height:22px;}
                                          </style>
                                  </td>
                              </tr>
                               <tr>
                                  <th>状态:</th>
                                  <td>
                                      <input type="radio" name="gstatus" value="1" checked>新品
                                      <input type="radio" name="gstatus" value="2">上架
                                      <input type="radio" name="gstatus" value="3">下架
                                  </td>
                              </tr>
                              <tr>
                                  <th></th>
                                  <td>
                                      <input style="width:100px;" type="submit" value="提交">
                                      <input style="width:100px;" onclick="history.go(-1)" type="button" value="返回">
                                  </td>
                              </tr>
                             
                              
                          </table>
                      </section>
                  </div>
                  </form>
                   
             

              <!-- page end-->
          </section>
      </section>

      <!--main content end-->
  @endsection