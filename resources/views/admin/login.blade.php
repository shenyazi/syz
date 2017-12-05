<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="{{ asset('admins/img/favicon.html') }}">

    <title>『Panda熊猫』-后台登录页</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('admins/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admins/css/bootstrap-reset.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('admins/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('admins/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admins/css/style-responsive.css') }}" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">

    <div class="container">
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
      <form class="form-signin" action="{{url('admin/dologin')}}" method="post">
      {{csrf_field()}}
        <h2 class="form-signin-heading">登录</h2>
        <div class="login-wrap">
            <input type="text" class="form-control" name="username" placeholder="用户名" autofocus value="{{old('username')}}">
            <input type="password" class="form-control" name="password" placeholder="密码">
            
                <input type="text" class="form-control" placeholder="验证码" name="code" style="width: 50%"> 
                
                <img src="{{url('admin/yzm')}}" onclick="this.src='{{url('admin/yzm')}}?'+Math.random()" >
           
                
            
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> 记住密码
                <span class="pull-right"> <a href="#"> 忘记密码?</a></span>
            </label>

            <button class="btn btn-lg btn-login btn-block" type="submit">登录</button>
            

        </div>

      </form>

    </div>


  </body>
</html>
