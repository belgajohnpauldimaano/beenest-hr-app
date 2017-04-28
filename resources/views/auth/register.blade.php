@extends('layouts.login')

@section('content')

<div class="container">
    <div class="row" style="margin:7%">
        <div class="col-md-8 col-md-offset-2">
          <div class="login-logo">
            <a href="{{ route('login')  }}">
                <b>Beenest</b>HR
            </a>
          </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="float:right">
                        <a href="{{ url('login') }}">
                            <i class="glyphicon glyphicon-arrow-left">&nbsp;</i>Back
                        </a>
                    </div>
                    <div>
                        Registrations
                    </div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" id="registrationForm" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Mobile no</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" >

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="float:right;">
                                     <i class="glyphicon glyphicon-floppy-save">&nbsp;</i>Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Page script -->
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script>
$( document ).ready(function() {

    $( "#registrationForm" ).validate({
        rules: {
            name: { required: true },
            email: { required: true },
            password: {
                required: true,
                minlength: 6,
                alphaNumSigns: true,
            },
            password_confirm: {
                required: true,
                minlength: 6,
                equalTo: '#password',
            },
        }
    });

});

</script>
@endsection
