@extends('layouts.main')

@section('content')
<form id="frm_log">
    <div class="login-box">
        <div class="callout callout-success" id="div_message" style="display: none;">
            <i><strong><h5>fsadf</h5></i></strong>
        </div>
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Leave</h3>
            </div>

            <div class="overlay hidden" id="div_leave_overlay" > <i class="fa fa-spin fa-refresh"></i> </div>

            {{ csrf_field() }}
            <div class="box-body" id="div_log_holder">
                <div class="help-block text-center" id="div_general_error-error">
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div> <!-- ./input-group-addon -->
                        <select name="select_leave_type" id="select_leave_type" class="form-control pull-right">
                            <option value="">Select a type of leave</option>
                            <option value="1">SL - Halfday</option>
                            <option value="2">SL - Wholeday</option>
                            <option value="3">VL - Halfday</option>
                            <option value="4">VL - Wholeday</option>
                        </select>
                    </div> <!-- ./input-group -->
                    <div class="help-block text-center" id="select_leave_type-error">
                    </div>
                </div> <!-- ./form-group -->

                <div class="form-group">
                    <label for="">Start Date</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div> <!-- /.input-group-addon -->
                        <input type="text" class="form-control pull-right leave_date_field" id="inp_date_from" name="inp_date_from" data-modal="true" data-min-year="2017" data-max-year="2030" data-large-default="true" data-large-mode="true" data-theme="dropper-custom-style">
                        <!--<input type="text" class="form-control pull-right leave_date_field" id="inp_date_from" data-leavetype="1" name="inp_date_today">-->
                    </div> <!-- /.input-group -->
                    <div class="help-block text-center" id="inp_date_from-error">
                    </div>
                </div> <!-- /.form-group -->
                
                <div class="form-group" id="div_form_group_to">
                    <label for="">Start Date</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div> <!-- /.input-group-addon -->
                        <input type="text" class="form-control pull-right leave_date_field" id="inp_date_to" name="inp_date_to" data-modal="true" data-min-year="2017" data-max-year="2030" data-large-default="true" data-large-mode="true" data-theme="dropper-custom-style">
                        <!--<input type="text" class="form-control pull-right leave_date_field" id="inp_date_to" data-leavetype="2" name="inp_date_today">-->
                    </div> <!-- /.input-group -->
                    <div class="help-block text-center" id="inp_date_to-error">
                    </div>
                </div> <!-- /.form-group -->

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
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('plugins/timedropper/timedropper.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/Datedropper3/datedropper.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/Datedropper3/dropper-custom-style.css') }}">
@endsection

@section('scripts')
    {{--<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>--}}
    <script src="{{ asset('plugins/timedropper/timedropper.js') }}"></script>
    <script src="{{ asset('plugins/Datedropper3/datedropper.js') }}"></script>

    <script>

        $( ".leave_date_field" ).dateDropper();

        $('body').on('change', '#select_leave_type', function () {
            if($(this).val() % 2 == 1)
            {
                $('#div_form_group_to').addClass('hidden');
            }
            else
            {
                $('#div_form_group_to').removeClass('hidden');
            }
        });

        $('body').on('submit', '#frm_log', function (e) {
            e.preventDefault();

            var formData = new FormData( $(this)[0] );
            $('#div_leave_overlay').removeClass('hidden');
            $.ajax({
                url     : "{{ route('request_leave') }}",
                type    : 'POST',
                data    : formData,
                dataType: 'JSON',
                processData : false,
                contentType : false,
                success : function (data) {
                    $('.help-block').empty();
                    $('#div_general_error-error').empty();

                    if(data['errRes'] == 1)
                    {
                        for(var err in data['errMsg']) // loop for each errors in the Error Message Bag
                        {
                            $('#select_leave_type-error').append('<code>' + data['errMsg'][err] + '</code>');
                        }
                    }
                    else if (data['errRes'] == 2) 
                    {
                        $('#div_general_error-error').empty().append('<code>'+data['errMsg']+'</code>');
                    }
                    else 
                    {
                        $('#div_message').slideToggle();
                        $('#div_message h5').empty().append(data['msg']);
                        setTimeout(function () {
                            $('#div_message').slideToggle(); 
                        }, 3000);
                    }
                    setTimeout(function () {
                        $('#div_leave_overlay').addClass('hidden');
                    }, 700);
                }
            });
        });
        $(function (){
            //$('#div_message').hide();

            // var selected_date = '';
            
            // $('body').on('click', '.leave_date_field', function() {
            //     var leavetype = $(this).data('leavetype');
            
            //     swal({
            //         title: 'Pick a date',
            //         html:
            //             "<div id='samplepicker'></div>",
            //         showCloseButton: true,
            //         showCancelButton: true,
            //         confirmButtonText:
            //             '<i class=""></i> Done!',
            //         cancelButtonText:
            //             '<i class=""></i> Cancel',
            //         onOpen : function () {
            //             $('#samplepicker').datepicker({}).on('changeDate', function (e) {
            //                 selected_date = e.format([0], 'dd-mm-yyyy');
            //             });
            //         }
            //     }).then(function() {
            //         swal({
            //             title   : 'Date was selected',
            //             type    : 'success',
            //             timer   : 1000
            //         }).then(function() {
            //             if (leavetype == 1) 
            //             {
            //                 $('#inp_date_from').val(selected_date);
            //             } else 
            //             {
            //                 $('#inp_date_to').val(selected_date);
            //             }
            //         }, function(dismiss) {
            //             if(dismiss == 'timer')
            //             {
            //                 if (leavetype == 1) 
            //                 {
            //                     $('#inp_date_from').val(selected_date);
            //                 } else 
            //                 {
            //                     $('#inp_date_to').val(selected_date);
            //                 }
            //             }
            //         });
            //     });
            // });
        })
    </script>
@endsection
