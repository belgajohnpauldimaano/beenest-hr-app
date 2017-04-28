@extends('layouts.dashboard')

@section('styles')

<link rel="stylesheet" href="{{ asset('plugins/timedropper/timedropper.css') }}">

<link rel="stylesheet" href="{{ asset('plugins/Datedropper3/datedropper.css') }}">

<link rel="stylesheet" href="{{ asset('plugins/Datedropper3/dropper-custom-style.css') }}">
    
<link href="{{asset('plugins/fullcalendar/fullcalendar.min.css')}}" rel='stylesheet' />

<link href="{{asset('plugins/fullcalendar/fullcalendar.print.css')}}" rel='stylesheet' media='print' />
<style>
.fc-day-grid-event .fc-event .fc-start .fc-end{
	/*background:green !important;*/
}
</style>
@endsection

@section('content')

	@if(Auth::user()->type === 'Admin')

	<div class="row">

	<div class="col-md-3">
	
		<div class="row">
		
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


		</div>


		<div class="row">
		
			<form id="frm_log2">
				<div class="login-box">
					<div class="callout callout-success" id="div_message2" style="display: none;">
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
		
		</div>
	
	</div>

	<div class="col-md-7">
	
		<form>

		<h3>
		
		<select name="user" id="user" class="form-control" style="width:200px;">

		<option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>

		@foreach($users as $user)

		<option value="{{ $user->id }}">{{ $user->name }}</option>

		@endforeach
		
		</select>

		</h3>

		</form>

	   	<div id='calendar' style="background:white; border-top:5px solid #3c8dbc; margin-left:0;" class="container"></div>

	</div>

	</div>

	@else

		<div class="row">

	<div class="col-md-3">
	
		<div class="row">
		
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


		</div>


		<div class="row">
		
			<form id="frm_log2">
				<div class="login-box">
					<div class="callout callout-success" id="div_message2" style="display: none;">
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
		
		</div>
	
	</div>

	<div class="col-md-7">

		<h3><input type="hidden" value="{{ Auth::user()->id }}" id="user">{{ Auth::user()->name }}'s Calendar</h3>

	   	<div id='calendar' style="background:white; border-top:5px solid #3c8dbc; margin-left:0;" class="container"></div>

	</div>

	</div>

	@endif
	

@endsection





@section('scripts')


<script src="{{ asset('plugins/timedropper/timedropper.js') }}"></script>

<script src="{{ asset('plugins/Datedropper3/datedropper.js') }}"></script>

<!--Today Script-->

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
                        $('#div_message h5').empty().append(data['msg']);
                        $('#div_message').slideToggle();
                        load_log_form();    

                        setTimeout(function () {
                            $('#div_message').slideToggle();
                        } , 3000);
						$('#calendar').fullCalendar('refetchEvents');
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
<!--End of Today-->


<!--Leave-->

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

        $('body').on('submit', '#frm_log2', function (e) {
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
                        $('#div_message2').slideToggle();
                        $('#div_message2 h5').empty().append(data['msg']);
                        setTimeout(function () {
                            $('#div_message2').slideToggle(); 
                        }, 3000);
						$('#calendar').fullCalendar('refetchEvents');
                    }
                    setTimeout(function () {
                        $('#div_leave_overlay').addClass('hidden');
                    }, 700);
                }
            });
        });
		</script>
		<!--End of Leave-->

 <!--Calendar -->
<script src="{{ asset('plugins/fullcalendar/fullcalendar.min.js') }}"></script>

@if(Auth::user()->type === 'Admin')

<script>

var BaseUrl = "{{ url('/') }}";

$(document).ready(function () {


	 $.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });


	$('#calendar').fullCalendar({

		//eventLimit: {

        //'month': 4, // adjust to 4 only for months

        //'default': true // display all events for other views

    	//},

		// header: {
		// 		left: 'prev,next today',
		// 		center: 'title',
		// 		right: 'month,agendaWeek,agendaDay,listWeek'
		// 	},


		eventLimit: true,

		events: {

		url: BaseUrl+"/dashboard/attendance/calendarAdmin",

		type:'POST',

		data: function () { // a function that returns an object

				return {

				user_id: $('#user').val(),
				
				}

			}
		},

		eventRender: function(event, element) {

			if(event.icon){          
				
				if(event.icon == 'check'){

					element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");

					element.css({'background':'green','text-align':'center'});

				}else{

					if(event.icon == 'sign-in'){

						element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");

						element.css({'background':'#4286f4','text-align':'center'});

					}

					if(event.icon == 'sign-out'){

						element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");

						element.css({'background':'#59309b','text-align':'center'});

					}

					if(event.icon == 'times'){

						element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");

						element.css({'background':'grey','text-align':'center'});
						
					}

					if(event.icon == 'leaf'){

						element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");

						element.css({'background':'green','text-align':'center'});
						
					}

					if(event.icon == 'leaf bg-grey'){

						element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");

						element.css({'background':'grey','text-align':'center'});
						
					}

					

				}

				//element.css({'background':'grey','text-align':'center'});
				
			}

		},

		eventClick: function(calEvent, jsEvent, view) {

			var t = $(this);

					if(calEvent.title == 'Overtime '){

						if(calEvent.value === 'check')
						{
							
							if(confirm('Disapprove overtime?') == true){
								
							
								//alert(BaseUrl+"/dashboard/attendance/isapproveOvertime/"+calEvent.id);

								$.ajax({

									url:BaseUrl+"/dashboard/attendance/isapproveOvertime/"+calEvent.id,

									type:'POST',

									data:{

										approved: 0,

									},

								});

								$('#calendar').fullCalendar('refetchEvents');
							

							}else{

								return false;

							}
							
							
						}else{

							if(confirm('Approve overtime?') == true){
								
							
								//alert(BaseUrl+"/dashboard/attendance/isapproveOvertime/"+calEvent.id);

								$.ajax({

									url:BaseUrl+"/dashboard/attendance/isapproveOvertime/"+calEvent.id,

									type:'POST',

									data:{

										approved: 1,

									},

								});

								$('#calendar').fullCalendar('refetchEvents');
							

							}else{

								return false;

							}

						}

					}

					if(calEvent.title == 'Attendance '){

						if(calEvent.value === 'check'){

							if(confirm('Disapprove Attendance?') == true){
								
							
								//alert(BaseUrl+"/dashboard/attendance/isapproveAttendance/"+calEvent.id);
								$.ajax({

									url:BaseUrl+"/dashboard/attendance/isapproveAttendance/"+calEvent.id,

									type:'POST',

									data:{

										approved: 0,

									},
								});

								$('#calendar').fullCalendar('refetchEvents');
							

							}else{

								return false;

							}

						}else{

							if(confirm('Approve Attendance?') == true){
								
							
								$.ajax({

									url:BaseUrl+"/dashboard/attendance/isapproveAttendance/"+calEvent.id,

									type:'POST',

									data:{

										approved: 1,

									}

								});

								$('#calendar').fullCalendar('refetchEvents');
							

							}else{

								return false;

							}

						}

					}

					if(calEvent.label == 'Leave'){

						if(calEvent.value === 'leaf'){

							if(confirm('Disapprove Leave?') == true){
								
							
								//alert(BaseUrl+"/dashboard/attendance/isapproveAttendance/"+calEvent.id);
								$.ajax({

									url:BaseUrl+"/dashboard/attendance/isapproveLeave/"+calEvent.id,

									type:'POST',

									data:{

										approved: 0,

									},

									
								});

								$('#calendar').fullCalendar('refetchEvents');
							

							}else{

								return false;

							}

						}else{

							if(confirm('Approve Leave?') == true){
								
							
								//alert(BaseUrl+"/dashboard/attendance/isapproveAttendance/"+calEvent.id);
								$.ajax({

									url:BaseUrl+"/dashboard/attendance/isapproveLeave/"+calEvent.id,

									type:'POST',

									data:{

										approved: 1,

									},

								});

								$('#calendar').fullCalendar('refetchEvents');
							

							}else{

								return false;

							}

						}

					}
			
			// change the border color just for fun

		}  

	});


	$('#user').change(function () {

		$('#calendar').fullCalendar('refetchEvents');

	});

});
</script>


@else

<script>

var BaseUrl = "{{ url('/') }}";

$(document).ready(function () {


	 $.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });


	$('#calendar').fullCalendar({

		//eventLimit: {

        //'month': 4, // adjust to 4 only for months

        //'default': true // display all events for other views

    	//},

		// header: {
		// 		left: 'prev,next today',
		// 		center: 'title',
		// 		right: 'month,agendaWeek,agendaDay,listWeek'
		// 	},


		eventLimit: true,

		events: {

		url: BaseUrl+"/dashboard/attendance/calendarUser",

		type:'POST',

		data: function () { // a function that returns an object

				return {

				user_id: $('#user').val(),
				
				}

			}
		},

		eventRender: function(event, element) {

			if(event.icon){          
				
				if(event.icon == 'check'){

					element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");

					element.css({'background':'green','text-align':'center'});

				}else{

					if(event.icon == 'sign-in'){

						element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");

						element.css({'background':'#4286f4','text-align':'center'});

					}

					if(event.icon == 'sign-out'){

						element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");

						element.css({'background':'#59309b','text-align':'center'});

					}

					if(event.icon == 'times'){

						element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");

						element.css({'background':'grey','text-align':'center'});
						
					}

					if(event.icon == 'leaf'){

						element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");

						element.css({'background':'green','text-align':'center'});
						
					}

					if(event.icon == 'leaf bg-grey'){

						element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");

						element.css({'background':'grey','text-align':'center'});
						
					}

					

				}

				//element.css({'background':'grey','text-align':'center'});
				
			}

		}  

	});


	$('#user').change(function () {

		$('#calendar').fullCalendar('refetchEvents');

	});

});
</script>

@endif

@endsection