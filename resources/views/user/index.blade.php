@extends('layouts.main')

@section('content')

<div class="box">
<div class="box-header with-border">
  <h3 class="box-title">Users</h3> <br>
  <a class="badge bg-blue" href="{{ URL::action('UserController@create') }}">c Create User</a>
  <a class="badge bg-grey" href="#" id="add-late"><span class="fa fa-clock-o"></span> Add Late</a>
  <a class="badge bg-brown" href="#" id="add-absent"><span class="fa fa-ban"></span> Add Absent</a>
</div>

<!-- /.box-header -->
<div class="box-body">

<div class="flash-message">
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
  @if(Session::has('alert-' . $msg))

  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
  @endif
@endforeach
</div> <!-- end .flash-message -->

  <table class="table table-bordered">
    <tbody>

    <tr>
      <th>Id</th>
      <th>Employee No</th>
      <th>Name</th>
      <th>Type</th>
      <th>Email</th>
      <th>Mobile</th>
      <th>VL</th>
      <th>SL</th>
      <th>Late</th>
      <th>Absent</th>
      <th>Actions</th>
    </tr>

    @foreach( $users as $user )
    <tr>
      <td>{{ $user->id }}</td>
      <td>{{ str_pad($user->employee_no,3,'0',STR_PAD_LEFT) }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->type }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->mobile }}</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>
        <a class="badge bg-blue" href="{!! URL::action('UserController@show', $user->id) !!}">
        <span class="glyphicon glyphicon-zoom-in"></span> Show
        </a> &nbsp;
        <a href="{!! URL::action('UserController@edit', $user->id) !!}" class="badge bg-orange">
        <span class="fa fa-edit"></span> Edit
        </a> &nbsp;
        <form class="form-horizontal" action="{{ URL::action('UserController@destroy', $user->id) }}"
            method="post" style="display:inline-block" enctype="multipart/form-data" accept-charset="UTF-8">
            <input name="_method" type="hidden" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <a id="alert{{$user->id}}" class="badge bg-red"><span class="fa fa-trash"></span> Delete</a>
        </form>
      </td>
    </tr>
    @endforeach

    </tbody>
  </table>
</div>

<!-- /.box-body -->
<div class="pagination"> {{ $users->links() }} </div>

@endsection

@section('scripts')

<script>
    $("a[id*=alert]").on("click", function(){

        if(confirm("Do you want to delete this item?")){
            $(this).parent('form').submit();
        }
        
    });
</script>

@endsection
