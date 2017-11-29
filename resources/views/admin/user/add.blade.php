@extends('layouts.admin')

@section('content')
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              用户添加
                          </header>
                          <div class="panel-body">
                              @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li style="color:red">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                              @endif
                              
                              <form class="form-horizontal" id="default" action="/user" method='post'>
                                  <fieldset title="Step1" class="step" id="default-step-0">
                                      <legend> </legend>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">用户名</label>
                                          <div class="col-lg-10">
                                              <input type="text" class="form-control" placeholder="用户名必须输入" name="username" value="{{ old('username')}}">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">密码</label>
                                          <div class="col-lg-10">
                                              <input type="text" class="form-control" placeholder="密码必须输入" name="password" value="{{ old('password')}}">
                                          </div>
                                      </div>
                                    
                                  </fieldset>
                                     {{csrf_field()}}
                                  <input type="submit" class="finish btn btn-danger" value="添加"/>
                              </form>
                          </div>
                      </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
  

   
@endsection



