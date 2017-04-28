@extends('layouts.main')

@section('content')
    
    <div class="row">
        <div class="col-md-12">

            @if(Auth::user()->type == 'Admin')
                <div class="row margin"  style="margin-left:0;padding-left:0">
                    <div class="col-sm-12 col-md-4 col-lg-3"  style="margin-left:0;padding-left:0">
                        <div class="fomr-group">
                            <label for="">Select User</label>
                            <select name="selected_user" id="selected_user" class="form-control">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @else 
                <input type="hidden" id="selected_user" value="{{ Auth::user()->id }}">
            @endif
            <div class="callout callout-success" id="div_message" style="display: none;">
                <i><strong><h5></h5></i></strong>
            </div>
            <div id="table_holder">
                <div class="box box-primary">
                    <div class="overlay">
                        <i class=" fa fa-refresh fa-spin"></i>
                    </div>

                    <div class="box-header with-border">
                        <h3 class="box-title">Attendance Summary</h3>
                    </div>
                    <div class="box-body">
                    </div>
                    <div class="box-footer">
                    </div>
                </div>
            </div>
        </div>

        
    </div>

    
                            



    <div class="modal fade in" id="modal_logout">
        <form id="frm_log_user">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Employee Logout</h4>
                    </div>

                    <div class="modal-body">
                            <input type="hidden" name="modal_id" id="modal_id">
                            <input type="hidden" name="inp_date_today" id="inp_date_today">
                            <input type="hidden" name="inp_current_user" id="inp_current_user" value="{{ Session::get('SESS_USER_ID') }}">
                            <input type="hidden" name="inp_log_type" id="inp_log_type" value="{{ encrypt(2) }}">
                            {{ csrf_field() }}
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    <label>Choose time :</label>

                                    <div class="input-group">
                                    <input type="text" class="form-control" id="inp_time_out" name="inp_time_out">

                                        <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div>
                                    

                                </div>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-flat btn-default" data-dismiss="modal" type="buton">Cancel</button>
                        <button class="btn btn-flat btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>

    <script>
        //configure timepicker
        var current_page = 1;
        $('#inp_time_out').timepicker({
            showInputs: false,
            minuteStep: 1
        });


        $(function () {
            @if(Auth::user()->type == 'Admin')
                $('#selected_user').val('{{ Auth::user()->id }}');
            @endif

            $('#inp_current_user').val($('#selected_user').val()); // change the current user that set in the modal

            fetch_record(1);
        });

        $('body').on('click', '#btn-logout', function () {
            var id = $(this).data('id');
            var date = $(this).data('date');

            $('#modal-id').val(id);
            $('#inp_date_today').val(date);

            $('#modal_logout').modal({backdrop : false});
        });
        function showMessage(msg)
        {
            $('#div_message h5').text(msg);
            $('#div_message').slideToggle();

            setTimeout(function () {
                $('#div_message').slideToggle();
            }, 3000);
        }
        // click delete button
        $('body').on('click', '.delete-attendance', function () {
            var id = $(this).data('id');
            if(confirm("Are you sure you want to delete?"))
            {
                $.ajax({
                    url     : "{{ route('delete_attendance') }}",
                    type    : 'POST',
                    data    : { id : id, _token : "{{ csrf_token() }}" },
                    dataType: 'JSON',
                    success : function (data){
                        //alert(data['errRes']);
                        if(data['errRes'] != 0)
                        {
                            showMessage(data['errMsg']);
                        }
                        else
                        {
                            // alert(data['Msg']);
                            showMessage(data['Msg']);
                            fetch_record(1);
                        }
                    }
                });
            }
        });

        $('body').on('change', '#selected_user', function () {
            fetch_record(1);
            $('#inp_current_user').val($('#selected_user').val()); // change the current user that set in the modal
        });

        $('body').on('submit', '#frm_log_user', function (e) {
            e.preventDefault();
            
            var formData = new FormData($(this)[0]);
            
            $.ajax({
                url         : "{{ route('log_user') }}",     
                type        : 'POST',
                data        : formData,
                dataType    : 'JSON',
                contentType : false,
                processData : false,
                success     : function (data) {
                    if(data['errRes'] == 0)
                    {
                        fetch_record(current_page);

                        $('#modal_logout').modal('hide');
                        showMessage(data['Msg']);
                        // swal({
                        //     title: data['Msg'],
                        //     text: '',
                        //     type: 'success',
                        //     timer: 2000
                        //     })
                    }
                    else if (data['errRes'] == 2) 
                    {
                        showMessage(data['errMsg']);
                        // swal({
                        //     title: data['errMsg'],
                        //     text: '',
                        //     type: 'error'
                        //     })
                    }
                    else
                    {
                        var msgs = '';
                        for(var msg in data['errMsg'])
                        {
                            msgs += '<code>'+ data['errMsg'][msg] +'</code><br />';
                        }
                        showMessage(msg);
                        // swal({
                        //     title: 'Error',
                        //     html: msgs,
                        //     type: 'error'
                        //     })
                    }
                }
            });

        });

        function fetch_record(page) 
        {
            current_page = page;
            $.ajax({
                url     : "{{ route('summary_list') }}",
                type    : 'POST',
                data    : { page : page, _token : '{{ csrf_token() }}', user : $('#selected_user').val()},
                success : function (data) {
                    $('#table_holder').empty().append(data);
                }

            });
        }
    </script>
@endsection