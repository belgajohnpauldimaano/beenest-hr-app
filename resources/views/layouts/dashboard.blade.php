<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->

    <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/skins/_all-skins.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">



    @yield('styles')
    <style>
        /*.bootstrap-timepicker-widget.dropdown-menu {
            z-index: 1050!important;
        }*/
    </style>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini" style="background:#ecf0f5">
<header class="main-header">
            <!-- Logo -->
            <a href="../../index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
            </a>
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="dist/img/uaser2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ session('USER_FULLNAME') }}</span>
                            </a>

                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="dist/img/auser2-160x160.jpg" class="img-circle" alt="User Image">

                                    <p>
                                        {{ session('USER_FULLNAME') }}
                                        <small>{{ session('USER_TYPE') }}</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                {{--<li class="user-body">
                                    <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                    </div>
                                    <!-- /.row -->
                                </li>--}}
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat" 
                                                    onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">Sign out</a>
                                                            
                                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>


                        </li>

                    </ul>
                </div>

            </nav>
        </header>
        <div class="container">

            @yield('content')

        </div>
        

    <!--Moment Js-->
    <script src="{{ asset('plugins/moment-js/moment.min.js') }}"></script>
    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/app.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>

   

    @yield('scripts')
</body>
</html>
