<div class="box box-primary">
    <div class="overlay">
        <i class=" fa fa-refresh fa-spin"></i>
    </div>

    <div class="box-header with-border">
        <h3 class="box-title">Leaves</h3>
    </div>
    <div class="box-body">
        {{ $leaves->links('layouts.data_list_pagination') }}
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>Leave Type</th>
                    <th>Date From</th>
                    <th>Date To</th>
                    <th>Status</th>
                    @if(Auth::user()->type == 'Admin')
                        <th>Action</th>
                    @endif
                </tr>
                @foreach($leaves as $leave)
                    <tr>
                        <td>{{ $leave->id }}</td>
                        <td>{{ $leave->type }}</td>
                        <td>{{ date('F d, Y - l', strtotime($leave->date_from)) }}</td>
                        <td>{{ date('F d, Y - l', strtotime($leave->date_to)) }}</td>
                        <td>{{ $leave->approved ? 'approved' : 'not approved' }}</td>
                        <td>
                        @if((Auth::user()->type == 'Admin')&&($leave->approved == 0))
                        <button class="btn btn-danger btn-flat delete-leave" data-id="{{ encrypt($leave->id) }}"> 
                            <i class="fa fa-trash"></i> Delete
                        </button>
                        @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $leaves->links('layouts.data_list_pagination') }}
    </div>
    <div class="box-footer">
    </div>
</div>