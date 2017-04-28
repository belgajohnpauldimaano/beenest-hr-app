@extends('layouts.main')

@section('content') 
<form id="frm_log">
    {{ csrf_field() }}
    <div class="login-box">
        <div class="callout callout-success" id="div_message" style="display: none;">
            <i><strong><h5>fsadf</h5></i></strong>
        </div>
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Today's Log</h3>
            </div>
            <div class="box-body" id="div_log_holder">

                <input type="hidden" value="{{ encrypt(Auth::user()->id) }}" name="inp_current_user" id="inp_current_user">

                <div class="form-group">
                    <label for="">Date</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div> <!-- /.input-group-addon -->
                        <input type="text" class="form-control pull-right" id="inp_date_today" name="inp_date_today" value="{{ date('m/d/Y') }}">
                    </div> <!-- /.input-group -->
                </div> <!-- /.form-group -->


                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <label for="">Log in</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div> <!-- /.input-group-addon -->
                            <input type="text" class="form-control pull-right timepicker" id="inp_time_in" name="inp_time_in">
                        </div> <!-- /.input-group -->
                    </div> <!-- /.form-group -->
                </div>


                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <label for="">Log out</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div> <!-- /.input-group-addon -->
                            <input type="text" class="form-control pull-right timepicker" id="inp_time_out" name="inp_time_out">
                        </div> <!-- /.input-group -->
                    </div> <!-- /.form-group -->
                </div> <!-- /.bootstrap-timepicker -->
                
                <div class="box-footer">
                    <button class="btn btn-flat btn-primary btn-block">Submit</button>
                </div>
                
            </div> <!-- / #div_log_holder -->
        </div>
    </div>
    
</form>

@endsection

@section('styles')
    {{--<link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('plugins/timedropper/timedropper.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/Datedropper3/datedropper.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/Datedropper3/dropper-custom-style.css') }}">

    
    
@endsection

@section('scripts')
    {{--<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>--}}
    <script src="{{ asset('plugins/timedropper/timedropper.js') }}"></script>
    <script src="{{ asset('plugins/Datedropper3/datedropper.js') }}"></script>


    <script>

        $('body').on('submit', '#frm_log', function (e) {
            e.preventDefault();
            var formData = new FormData( $(this)[0] );
            $.ajax({
                url     : "{{ route('log_user') }}",
                type    : 'POST',
                data    : formData,
                dataType    : 'JSON',
                processData : false,
                contentType : false,
                success     : function (data) {
                    $('.help-block').empty();
                    if(data['errRes'] == 1)
                    {
                        for(var err in data['errMsg'])
                        {
                            $('#'+err+'-error').append('<code>'+ data['errMsg'][err] +'</code>');
                        }
                    }
                    else if(data['errRes'] == 2)
                    {
                        var msg = '<div class="callout callout-danger">';
                            msg += '<p>'+ data['errMsg'] +'</p>';
                            msg += '</div>';
                        $('.msg-holder').empty().append(msg);
                    }
                    else
                    {
                        $('#div_message h5').empty().append(data['Msg']);
                        $('#div_message').slideToggle();
                        load_log_form();    

                        setTimeout(function () {
                            $('#div_message').slideToggle();
                        } , 3000);
                    }
                }
            });
        });

        $('body').on('click', '.pick-submit', function() {
            load_log_form();
        })

        $(function () {
            load_log_form();
        })

        function load_log_form () {

            var date = $('#inp_date_today').val();
            var user_id = $('#inp_current_user').val();

            $.ajax({
                url         : "{{ route('log_form') }}",
                type        : 'POST',
                data        : { id : user_id, date : date, _token : "{{ csrf_token() }}" },
                success     : function (data) {
                    $('#div_log_holder').empty().append(data);
                }
            });
        }
    </script>
@endsection