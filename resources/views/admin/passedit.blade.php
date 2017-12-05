@extends('layouts.admin')
@section('title')
    后台用户修改密码页面
@endsection
@section('content')
<!--main content start-->
      <section id="main-content">
          <section class="wrapper">
           <div class="row">
                  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                              修改密码
                          </header>
                          <div class="panel-body">
                              <form role="form" action="/admin/password" method="post">
                                  
                                  {{ csrf_field() }}
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">旧密码</label>
                                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="oldpassword">
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputPassword1">新密码</label>
                                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="newpassword">
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputPassword1">确认密码</label>
                                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="repassword">
                                  </div>
                                  
                                  <div class="mws-button-row">
				                    <input type="submit" value="提交" class="btn btn-danger">
				                    <input type="reset" value="重置" class="btn ">
				                </div>
                              </form>

                          </div>
                      </section>
                  </div>
              </div>
          </section>
    </section>
@endsection