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
                          <form id="#bd" action="{{url('/admin/good')}}" method="POST">
                           {{csrf_field()}}
                           
                          <table class="table table-bordered">
                              
                              <tr >
                                  <th>分类:</th>
                                  
                                  <td>
                                      <select class="form-control" id="inputPassword2">  
                                        <option  value="请选择" >请选择</option>  
                                       
                                       </select>  
                                  </td>
                                 
                              </tr>
                              <tr>
                                  <th>商品名称:</th>
                                  <td>

                                      <input class="form-control" id="inputPassword3" type="text" name="gname" placeholder="请填写您的商品名称">
                                     
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
                              <tr>
                                  <th>商品图片:</th>
                                  <td>
                                      <input type="file" name="gpic">
                                  </td>
                              </tr>
                               <tr>
                                  <th>商品描述:</th>
                                  <td>
                                      <textarea class="form-control" id="inputPassword2" name="goodsDes" placeholder="请对您的商品进行描述"></textarea>
                                  </td>
                              </tr>
                               <tr>
                                  <th>状态:</th>
                                  <td>
                                      <input type="radio" name="gstatus" value="1" checked>新品
                                      <input type="radio" name="gstatus" value="1">上架
                                      <input type="radio" name="gstatus" value="1">下架
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
                   <script type="text/javascript">
                   

                    
                        $("input").focus(function(){

                               $(this).attr('placeholder','');
                              
                        });
                        
                        // $("input").blur(function(){
                          
                            
                        //    var data = new FormData($('#bd')[0]);
                        //    data.append('_token',"{{csrf_token()}}");
                          
                        //   $.ajax({
                        //     type:"POST",
                            
                        //     url:"{{url('/admin/good')}}",
                        //     data:data,
                        //     async: true,
                            
                        //     cache: false,
                        //     contentType: false,
                        //     processData: false,
                        //     success:function(data)
                        //     {
                              
                        //       console.log(1);
                        //     },
                        //     error: function(XMLHttpRequest, textStatus, errorThrown) {
                        //                     alert("上传失败，请检查网络后重试");
                        //                 }
                        //   });


                        // });


                            
                   </script>
                  
             

              <!-- page end-->
          </section>
      </section>

      <!--main content end-->
  @endsection