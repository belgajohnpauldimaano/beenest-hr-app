@extends('layouts.main')

@section('content')

<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title">New User</h3>
  <a class="badge bg-orange pull-right" href="/users">
  <span class="fa fa-arrow-left"> </span> Back
  </a>
</div>
<!-- /.box-header -->
<!-- form start -->
<form role="form" action="{{ URL::action('UserController@store') }}" method="post" enctype="multipart/form-data" accept-charset="UTF-8" id="registrationForm">

  {!! csrf_field() !!}

  <div class="box-body">
    <div class="form-group">
      <label for="image">Photo</label><br>
      <img src="/images/bee.png" class="user-image" alt="User Image">
      <input id="image" name="image" type="file">
    </div>

    <div class="form-group">
      <label for="employee_no">Employee Number</label>
      <input class="form-control" id="employee_no" name="employee_no" placeholder="Employee Number" type="text" maxlength="3" autofocus>
    </div>

    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" id="name" name="name" placeholder="Name" type="text" autocomplete="off">
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input class="form-control" id="password" name="password" placeholder="Password" type="password">
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" id="email" name="email" placeholder="Email" type="email" autocomplete="off">
    </div>

    <div class="form-group">
      <label for="name">Type</label>
      <select class="form-control" name="type" >
        @foreach ( $user_types as $type)
          <option value="{{ $type }}">{{ $type }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="mobile">Mobile</label>
      <input class="form-control" id="mobile" name="mobile" placeholder="Mobile" type="text" autocomplete="off">
    </div>

    <div class="form-group">
      <label for="start_date">Start Date</label>
      <input type="text" name="start_date" class="form-control datepicker" placeholder="Start date">
    </div>

    <div class="form-group">
      <label for="end_date">End Date</label>
      <input type="text" name="end_date" class="form-control  datepicker" placeholder="End date">
    </div>

    <div class="form-group">
      <label for="name">TIN</label>
      <input class="form-control" id="tin" name="meta[tin]" placeholder="Tin" type="text" autocomplete="off">
    </div>

    <div class="form-group">
      <label for="name">SSS</label>
      <input class="form-control" id="sss" name="meta[sss]" placeholder="SSS" type="text" autocomplete="off">
    </div>

    <div class="form-group">
      <label for="name">Pagibig</label>
      <input class="form-control" id="Pagibig" name="meta[pagibig]" placeholder="Pagibig" type="text" autocomplete="off">
    </div>

    <div class="form-group">
      <label for="name">Philhealth</label>
      <input class="form-control" id="Philhealth" name="meta[philhealth]" placeholder="Philhealth" type="text" autocomplete="off">
    </div>

    <div class="form-group">
      <label for="name">Passport</label>
      <input class="form-control" id="Passport" name="meta[passport]" placeholder="Passport" type="text" autocomplete="off">
    </div> 

    <div class="form-group">
      <label for="name">Drivers License</label>
      <input class="form-control" id="drivers_license" name="meta[drivers_license]" placeholder="Drivers license" type="text" autocomplete="off">
    </div>            
  </div>
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" class="btn btn-primary btn-flat">
      <span class="fa fa-floppy-o"> </span> Save
    </button>
  </div>
</form>
</div>


@endsection


@section('styles')
  <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
@endsection


@section('scripts')

<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.13.1/additional-methods.js"></script>
<!-- Page script -->
<script>
$( document ).ready(function() {

  //Date picker
  $('.datepicker').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
  });

  $( "#registrationForm" ).validate({
      rules: {
          image: { accept: "image/jpg,image/jpeg,image/png,image/gif"},
          employee_no: { required: true },
          name: { required: true },
          email: { required: true },
          password: {
              required: true,
              minlength: 6,
              alphaNumSigns: true,
          },
          start_date: { required: true },          
      },
      messages: {
          image: { accept: 'Invalid image' }
      }
  });
});
</script>
@endsection
