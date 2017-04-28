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
    <link href="{{ asset('dist/css/AdminLTE.css') }}" rel="stylesheet">
    <style>
        .bootstrap-timepicker-widget.dropdown-menu {
            z-index: 1050!important;
        }
        .error {
            color: red;
        }        
    </style>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">

            @php
            if (!empty(Auth::user()->image)) {
                $img_src = '/images/profile/'.Auth::user()->image.'';
            }
            else {
                $img_src = '/images/bee.png';
            }
            @endphp

            <!-- Logo -->
            <a href="/dashboard/calendar" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>Bee</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Beenest</b>HR</span>
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
                                <img src="{{ $img_src }}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>

                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{{ $img_src }}" class="img-circle" alt="User Image">
                                    <p>
                                        {{ Auth::user()->name }}
                                        <small>{{ Auth::user()->type }}</small>
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
                                        <a href="{!! URL::action('UserController@show', Auth::user()->id) !!}" class="btn btn-default btn-flat">Profile</a>
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

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                <img src="{{ $img_src }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ strtoupper(Auth::user()->name) }}</p>
                    <p style="font-style: italic;font-size:12px;">
                        <a href="{!! URL::action('UserController@edit', Auth::user()->id) !!}">Edit my profile</a>
                    </p>
                </div>

            </div>

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <section style="color: white;padding: 10px 30px;">
                <div>Absent | 0</div>
                <div>Late | 0</div>
                <div>SL | {{ Session::get('sickleave') }}</div>
                <div>VL | {{ Session::get('vacationleave') }}</div>
                </section>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li><a href="{{ route('calendar') }}"><i class="fa fa-circle-o text-aqua"></i> <span>Calendar</span></a></li>
                    <li><a href="{{ route('summary') }}"><i class="fa fa-circle-o text-aqua"></i>Attendance</a></li>
                    <li><a href="{{ route('leave') }}"><i class="fa fa-circle-o text-aqua"></i> <span>Leaves</span></a></li>
                    @if( Auth::user()->type == 'Admin' )
                    <li><a href="{!! URL::action('UserController@index') !!}"><i class="fa fa-users"></i> <span>Users</span></a></li>
                    <li><a href="{{ route('announcement') }}"><i class="fa fa-sticky-note"></i> <span>Announcements</span></a></li>
                    @endif
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!--
        <section class="content-header">
            <h1>
                @yield('page-title')
            <small>@yield('page-description')</small>
            </h1>
            <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            </ol>
        </section>
        -->

        <!-- Main content -->
        <section class="content">

            @yield('content')

        </section>
        <!-- Main content -->

        </div>
        <!-- Content Wrapper. Contains page content -->


        <footer class="main-footer">
            <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; 2017 <a href="#">Beenest Technology Solutions</a>.</strong> All rights
            reserved.
        </footer>
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

    <script>
    
    </script>
</body>
</html>
