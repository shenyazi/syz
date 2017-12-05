@extends('layouts.admin')
@section('title')
    后台首页
@endsection

@section('content')
	 <section id="main-content">
        <section class="wrapper">
          <div class="row">
                  <div class="col-lg-12">
                      <section class="panel text-center">
                          <header class="panel-heading">
                             『Panda熊猫』后台基本信息
                          </header>
                          <div class="panel-body ">
                              <form class="form-horizontal " id="default">
                                  <fieldset title="Step 3" class="step " id="default-step-2" style='margin-left:300px'>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label icon-windows"> 操作系统</label>
                                          <div class="col-lg-10">
                                              <p class="form-control-static">{{PHP_OS}}</p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label icon-pinterest"> 运行环境</label>
                                          <div class="col-lg-10">
                                              <p class="form-control-static">{{$_SERVER['SERVER_SOFTWARE']}}</p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label icon-repeat"> PHP运行方式</label>
                                          <div class="col-lg-9">
                                              <p class="form-control-static">apache2handler</p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label icon-file"> 上传附件限制</label>
                                          <div class="col-lg-9">
                                              <p class="form-control-static"><?php echo get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件"; ?> </p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label icon-time"> 北京时间</label>
                                          <div class="col-lg-10">
                                              <p class="form-control-static" id="time"></p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label icon-globe"> 服务器域名/IP</label>
                                          <div class="col-lg-9">
                                              <p class="form-control-static">{{$_SERVER['SERVER_NAME']}}</p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-1 control-label icon-home"> Host</label>
                                          <div class="col-lg-10">
                                              <p class="form-control-static">{{$_SERVER['SERVER_ADDR']}}</p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-3 control-label  icon-rocket"> godman_设计-版本</label>
                                          <div class="col-lg-8">
                                              <p class="form-control-static">v-0.1</p>
                                          </div>
                                      </div>
                                  </fieldset>
                              </form>
                          </div>
                      </section>
                  </div>
              </div>
              <!-- page end-->
             
             <script type="text/javascript">
                     
                  setInterval(function () {
                    var date = new Date();
                    var month = date.getMonth()+1;
                    $('#time').html(date.getFullYear() + "年" + month + "月" + date.getDate() + '日' + date.getHours() + ":"+date.getMinutes()+':'+date.getSeconds());
                  }, 1000);

                </script>

          </section>
      </section>
@endsection