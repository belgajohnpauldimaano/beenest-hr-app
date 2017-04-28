@extends('layouts.main')

@section('content')

<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title">Show User</h3>
  <a class="badge bg-orange pull-right" href="/users">
  <span class="fa fa-arrow-left"> </span> Back
  </a>
</div>
<!-- /.box-header -->
<!-- form start -->
<form class="form" accept-charset="UTF-8" id="updateForm">

  <div class="box-body">
    <div class="form-group">
      <label for="image">Photo</label><br>
      @if (!empty($user->image))
        <img src="/images/profile/{{ $user->image }}" class="img-thumbnail">
      @else
        <img src="/images/bee.png" class="user-image" alt="User Image">
      @endif
    </div>

    <div class="form-group">
      <label for="employee_no">Employee Number</label>
      <span>{{ str_pad($user->employee_no,3,'0',STR_PAD_LEFT) }}</span>
    </div>

    <div class="form-group">
      <label for="name">Name</label>
      <span>{{ $user->name }}</span>
    </div>

    <div class="form-group">
      <label for="name">Type</label>
      <span>{{ $user->type }}</span>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <span>{{ $user->email }}</span>
    </div>

    <div class="form-group">
      <label for="mobile">Mobile</label>
      <span>{{ $user->mobile }}</span>
    </div>

    <div class="form-group">
      <label for="start_date">Start Date</label>
      <span>{{ $user->start_date ? $user->start_date->format('Y-m-d') : '' }}</span>
    </div>

    <div class="form-group">
      <label for="end_date">End Date</label>
      <span>{{ $user->end_date ? $user->end_date->format('Y-m-d') : '' }}</span>
    </div>

    <div class="form-group">
      <label for="name">TIN</label>
      <span>{{ isset($usermeta['tin']) ? $usermeta['tin'] : '' }}</span>
    </div>

    <div class="form-group">
      <label for="name">SSS</label>
      <span>{{ isset($usermeta['sss']) ? $usermeta['sss'] : '' }}</span>
    </div>

    <div class="form-group">
      <label for="name">Pagibig</label>
      <span>{{ isset($usermeta['pagibig']) ? $usermeta['pagibig'] : '' }}</span>
    </div>

    <div class="form-group">
      <label for="name">Philhealth</label>
      <span>{{ isset($usermeta['philhealth']) ? $usermeta['philhealth'] : '' }}</span>
    </div>

    <div class="form-group">
      <label for="name">Passport</label>
      <span>{{ isset($usermeta['passport']) ? $usermeta['passport'] : '' }}</span>
    </div> 

    <div class="form-group">
      <label for="name">Drivers License</label>
      <span>{{ isset($usermeta['tin']) ? $usermeta['tin'] : '' }}</span>
    </div> 

  </div>
  <!-- /.box-body -->

</form>
</div>


@endsection
