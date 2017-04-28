


<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Attendance Summary</h3>
    </div>
    <div class="box-body">
        {{ $attendances->links('attendance/summary/data_list_pagination') }}
        
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Log In</th>
                    <th>Log Out</th>
                    <th>Overtime</th>
                    @if(Auth::user()->type == 'Admin')
                        <th>Action</th>
                    @endif
                </tr>
                @foreach($attendances as $a)
                    <tr>
                        <td>{{$a->id}}</td>
                        <td>{{ date('F d Y - l', strtotime($a->date)) }}</td>
                        <td>{{ date('h:i:s a', strtotime($a->time_in)) }}</td>
                        @if($a->time_out)
                            <td>{{ date('h:i:s a', strtotime($a->time_out)) }}</td>
                        @else
                            <td><button class="btn btn-flat btn-danger" id="btn-logout" data-date="{{$a->date}}" data-id="{{ encrypt($a->id) }}"> Log out </button></td>
                        @endif
                        @if($a->overtime)
                            <td>
                                @if($a->overtime->overtime < 1 && $a->overtime->overtime > 0)
                                    {{$a->overtime->overtime * 60 }}
                                    Minutes
                                @elseif($a->overtime->overtime >= 1)
                                    {{$a->overtime->overtime}}
                                    Hour(s)
                                @endif
                            </td>
                        @else
                            <td>0</td>
                        @endif

                        @if(Auth::user()->type == 'Admin')
                        <td>
                            <button class="btn btn-flat btn-danger delete-attendance" data-id="{{ encrypt($a->id) }}"> <i class="fa fa-trash"></i> Delete</button>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

            {{ $attendances->links('attendance/summary/data_list_pagination') }}
    </div>
</div>