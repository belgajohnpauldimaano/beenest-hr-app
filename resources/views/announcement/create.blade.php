@extends('layouts.main')

@section('content')
<div class="box">

<div class="box-header with-border">

  <h3 class="box-title">Create Announcement</h3>
  <a class="badge bg-orange pull-right" href="{{ route('announcement') }}"><span class="fa fa-arrow-left"> </span> Back</a>
</div>

    <div class="box-body">
    
   
    <form  role="form" method="POST" action="{{ route('storeAnnouncement') }}">

        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">

            <label for="note">Note</label>

                <textarea id="note" cols="5" rows="10" class="form-control" name="note" value="{{ old('note') }}" required autofocus style="resize:none"></textarea>

                @if ($errors->has('note'))

                    <span class="help-block">

                        <strong>{{ $errors->first('note') }}</strong>

                    </span>

                @endif

        </div>

        <div class="box-footer">
        
       
            <div class="form-group">

                <button type="submit" class="btn btn-primary btn-flat">

                    <span class="fa fa-floppy-o"> </span> Register

                </button>

            </div>

        </form>

         </div>

     </div>
      
</div>
@endsection