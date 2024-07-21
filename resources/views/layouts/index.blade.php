<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="#" type="image/x-icon" />
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('adminlte/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/ionslider/ion.rangeSlider.min.js') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    @yield('css')
    <style>
        .navbar-nav>li>a {
            background-color: #32642d !important;
            /* Modify this color as needed */
            color: white !important;
            /* Ensure the text color is visible */
        }

        .navbar-nav>li>a:hover {
            background-color: #2a5023 !important;
            /* Modify this color for hover effect */
        }

        .navbar-header {
            display: flex;
            align-items: center;
        }

        .navbar-header .navbar-brand {
            padding: 0 20px;
            margin: 0 15px;
            font-size: 18px;
            line-height: 1.3;
            font-weight: bold;
            color: white !important;
            text-align: center;
        }

        .navbar-header .navbar-brand b {
            display: block;
        }

        .navbar-header .navbar-toggle {
            margin-left: 15px;
        }

        .navbar-header img.user-image {
            width: 55px;
            margin-right: 10px;
        }
    </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin layout-top-nav">
    <div class="wrapper">

        <header class="main-header " style="background-color:#32642d !important">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        {{-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('adminlte/dist/img/logo-mts.png') }}" class="user-image"
                                alt="User Image">
                        </a> --}}
                        <a href="{{ route('index') }}" class="navbar-brand">
                            <b>Aplikasi</b>Pengunjung
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('adminlte/dist/img/logo-mts.png') }}" class="user-image"
                            alt="User Image" style="width: 5%; float:left">
                    </a>
                    <div class="navbar-header">
                        <a href="{{ route('index') }}" class="navbar-brand"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PPDB<br> MTS </b>N 2 SLEMAN</a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>-->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="{{ route('index') }}"><i class="fa fa-home"></i>
                                    <span class="hidden-xs ">Beranda</span>
                                </a>
                            </li>
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="{{ route('pengunjung') }}"><i class="fa fa-pencil-square-o"></i>
                                    <span class="hidden-xs ">Form Pengunjung</span>
                                </a>
                            </li>
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i>
                                    <span class="hidden-xs ">Login</span>
                                </a>
                            </li>
                            {{-- <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user"></i><span class="hidden-xs "> {{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-footer">
                                        <a class="button" href="{{ route('user.profile') }}"
                                            class="btn btn-default btn-flat"><i class="fa fa-gear"></i>Profile</a><br />
                                        <a class="button" href="{{ route('logout') }}"
                                            class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i>Log out</a>
                                    </li>
                            </li> --}}
                    </div>
                    <!-- /.navbar-custom-menu -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
        <!-- Full Width Column -->
        <div class="content-wrapper">
            <div class="container">
                <!-- Content Header (Page header) -->
                @yield('content')
                <!-- /.content -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Pengunjung</b>
            </div>
            <strong>&copy; 2024</strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('adminlte/plugins/fastclick/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/app.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
    @yield('javascript')
</body>

</html>
