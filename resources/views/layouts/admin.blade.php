<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="{{ asset('/admins/img/favicon.html') }}">

    <title>『Panda熊猫』-@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/admins/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/admins/css/bootstrap-reset.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('/admins/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('/admins/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('/admins/css/owl.carousel.css') }}" type="text/css">
    <!-- Custom styles for this template -->
    <link href="{{ asset('/admins/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/admins/css/style-responsive.css') }}" rel="stylesheet" />
       <script type="text/javascript" src="{{ asset('/js/jquery-1.8.3.min.js')}}"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" class="">
      <!--header start-->
      <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
            </div>
            <!--logo start-->
            <a href="#" class="logo">Flat<span>lab</span></a>
            <!--logo end-->
           
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder="Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{ asset('/admins/img/avatar1_small.jpg') }}">
                            <span class="username">Jhon Doue</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#"><i class=" icon-suitcase"></i>个人中心</a></li>
                            <li><a href="#"><i class="icon-cog"></i> 设置</a></li>
                            <li><a href="#"><i class="icon-bell-alt"></i> 修改密码</a></li>
                            <li><a href="login.html"><i class="icon-key"></i> 退 出</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">
                  <li class="active">
                      <a class="" href="index.html">
                          <i class="icon-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>用户管理</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="general.html">用户添加</a></li>
                          <li><a class="" href="buttons.html">用户浏览</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-cogs"></i>
                          <span>Components</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="grids.html">Grids</a></li>
                          <li><a class="" href="calendar.html">Calendar</a></li>
                          <li><a class="" href="charts.html">Charts</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-tasks"></i>
                          <span>Form Stuff</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="form_component.html">Form Components</a></li>
                          <li><a class="" href="form_wizard.html">Form Wizard</a></li>
                          <li><a class="" href="form_validation.html">Form Validation</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-th"></i>
                          <span>商品管理</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="{{url('/admin/good/create')}}">添加商品</a></li>
                          <li><a class="" href="dynamic_table.html">浏览商品</a></li>
                      </ul>
                  </li>
                  <li>
                      <a class="" href="inbox.html">
                          <i class="icon-envelope"></i>
                          <span>Mail </span>
                          <span class="label label-danger pull-right mail-info">2</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon-glass"></i>
                          <span>Extra</span>
                          <span class="arrow"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="blank.html">Blank Page</a></li>
                          <li><a class="" href="profile.html">Profile</a></li>
                          <li><a class="" href="invoice.html">Invoice</a></li>
                          <li><a class="" href="404.html">404 Error</a></li>
                          <li><a class="" href="500.html">500 Error</a></li>
                      </ul>
                  </li>
                  <li>
                      <a class="" href="login.html">
                          <i class="icon-user"></i>
                          <span>Login Page</span>
                      </a>
                  </li>
				         </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      <!--main content start-->
        @section('content')

        @show
      <!--main content end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ asset('/admins/js/jquery.js') }}"></script>
    <script src="{{ asset('/admins/js/jquery-1.8.3.min.js') }}"></script>
    <script src="{{ asset('/admins/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admins/js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('/admins/js/jquery.nicescroll.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/admins/js/jquery.sparkline.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/admins/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>
    <script src="{{ asset('/admins/js/owl.carousel.js') }}" ></script>
    <script src="{{ asset('/admins/js/jquery.customSelect.min.js') }}" ></script>

    <!--common script for all pages-->
    <script src="{{ asset('/admins/js/common-scripts.js') }}"></script>

    <!--script for this page-->
    <script src="{{ asset('/admins/js/sparkline-chart.js') }}"></script>
    <script src="{{ asset('/admins/js/easy-pie-chart.js') }}"></script>

  <script>

      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>


       