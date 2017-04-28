@extends('layouts.login')

@section('content')

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
   <b>Beenest</b>HR
  </div>
  <!-- /.login-logo -->
  <!--<div class="login-box-body" style="padding: 40px;">-->
  <div style="padding: 40px;">

    <p class="login-box-msg" style="color: #fff">Sign in to start your session</p>

    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

      <div class="form-group has-feedback">
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
          <span class="help-block alert-warning">
              <strong>{{ $errors->first('email') }}</strong>
          </span>
        @endif
      </div>

      <div class="form-group has-feedback">
        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
          <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
        @endif
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>

              <!--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me-->

            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center" style="margin-top: 10px;">
      <a class="btn btn-block btn-flat" href="{{ route('password.request') }}" style="color: #fff;padding: 0px;">
        <i class="fa fa-key">&nbsp;</i>Forgot Your Password?
      </a>
      <a class="btn btn-block btn-flat" href="{{ route('register') }}" style="color: #fff;padding: 0px;">
        <i class="fa fa-user-plus">&nbsp;</i>Register</a>
    </div>


  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

@endsection
