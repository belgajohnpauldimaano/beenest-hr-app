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

    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">


    @yield('styles')
    <link href="{{ asset('dist/css/AdminLTE.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <style type="text/css">
        #login-body {
            background: -webkit-linear-gradient(top, rgba(0,0,0,0.75) 0%,rgba(0,0,0,.3) 70%), url(/images/header-bg-1.jpg) center 70% no-repeat;
            background: -moz-linear-gradient(top, rgba(0,0,0,0.75) 0%,rgba(0,0,0,.3) 70%), url(/images/header-bg-1.jpg) center 70% no-repeat;
            background: -ms-linear-gradient(top, rgba(0,0,0,0.75) 0%,rgba(0,0,0,.3) 70%), url(/images/header-bg-1.jpg) center 70% no-repeat;
            background: -o-linear-gradient(top, rgba(0,0,0,0.75) 0%,rgba(0,0,0,.3) 70%), url(/images/header-bg-1.jpg) center 70% no-repeat;
            background: linear-gradient(top, rgba(0,0,0,0.75) 0%,rgba(0,0,0,.3) 70%), url(/images/header-bg-1.jpg) center 70% no-repeat;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body class="hold-transition login-page" id="login-body">
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>

    @yield('scripts')
</body>
</html>
