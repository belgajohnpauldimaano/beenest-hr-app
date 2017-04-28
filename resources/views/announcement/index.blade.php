@extends('layouts.main')

@section('content')


@if(Session::has('success'))
        <div class="alert alert-success fade in alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            {{ Session::get('success') }}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-warning fade in alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            {{ Session::get('error') }}
        </div>
    @endif

    
  <div class="box">
    <div class="box-header with-border">
    <h3 class="box-title">Announcements</h3> <br> <a class="badge bg-blue" href="{{ route('createAnnouncement') }}"><span class="fa fa-sticky-note-o"></span> Create Announcement</a>
    </div>


    
    <div class="box-body">
    @if($announcements->count() > 0 )
        <table class="table table-responsive table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Note</th>
                    <th>Active</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($announcements as $announcement)
                    <tr>
                    <td>{{ $announcement->id }}</td>
                    <td>{{ $announcement->user_id }}</td>
                    <td><a href="{{ route('showAnnouncement', $announcement->id)}}">{{ $announcement->note }}</a></td>
                    <td>{{ $announcement->active }}</td>
                    <td>{{ $announcement->created_at }}</td>
                    <td>{{ $announcement->updated_at }}</td>
                    <td><a class="badge bg-orange" href="{{ route('editAnnouncement', $announcement->id) }}"> <span class="fa fa-edit"></span> Edit</a> &nbsp; <form class="pull-left" style="margin-right:5px;" action="{{ route('destroyAnnouncement',$announcement->id) }}" method="GET" id="submit">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <a id="alert{{$announcement->id}}" class="badge bg-red"><span class="fa fa-trash"></span> Delete</a>
                    </form>
                    </td>
                    </tr>
                @endforeach

            </tbody>

        </table>

        {{ $announcements->links() }}

    @endif
    </div>
    </div>
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