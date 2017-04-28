                
                
                <div class="msg-holder"></div>
                <div class="help-block text-center " id="inp_log_type-error">
                </div>
                <div class="help-block text-center" id="inp_current_user-error">
                </div>
                <input type="hidden" value="{{ $current_user_id }}" name="inp_current_user" id="inp_current_user">
                
                @if($attendance == NULL)
                    <input type="hidden" value="{{ encrypt(1) }}" name="inp_log_type">
                @else
                    <input type="hidden" value="{{ encrypt(2) }}" name="inp_log_type">
                @endif
                <div class="form-group">
                    <label for="">Date</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div> <!-- /.input-group-addon -->

                        {{--@if($attendance)
                            <label class="form-control pull-right">{{ $attendance->date }}</label>
                        @else--}}
                            {{-- data-default-date="{{ date('m/d/Y', strtotime($attendance->date)) }}" --}}
                            <?php
                                if($attendance)
                                {
                                    $date =  date('m/d/Y', strtotime($attendance->date));
                                }
                                else
                                {
                                    $date =  $selected_date;
                                }
                            ?>
                            <input type="text" class="form-control pull-right" id="inp_date_today" name="inp_date_today" data-default-date="{{ $date }}"  data-modal="true" data-min-year="2017" data-max-year="2030" data-large-default="true" data-large-mode="true" data-theme="dropper-custom-style">

                    </div> <!-- /.input-group -->
                            <div class="help-block text-center" id="inp_date_today-error"></div>
                </div> <!-- /.form-group -->


                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <label for="">Time in</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div> <!-- /.input-group-addon -->
                            @if($attendance == NULL)
                                <input type="text" class="form-control pull-right timepicker" id="inp_time_in" name="inp_time_in">
                            @else
                                    <lable class="form-control pull-right">{{ date('h:i:s a', strtotime($attendance->time_in)) }}</label>
                            @endif
                        </div> <!-- /.input-group -->
                            <div class="help-block text-center" id="inp_time_in-error"></div>
                    </div> <!-- /.form-group -->
                </div>


                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <label for="">Time out</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div> <!-- /.input-group-addon -->
                            @if($attendance == NULL)
                                <input type="text" class="form-control pull-right timepicker" id="inp_time_out" name="inp_time_out">
                            @else
                                @if($attendance->time_out == '00:00:00' || $attendance->time_out == '')
                                    <input type="text" class="form-control pull-right timepicker" id="inp_time_out" name="inp_time_out">
                                @else
                                    <lable class="form-control pull-right">{{ date('h:i:s a', strtotime($attendance->time_out)) }}</label>
                                @endif
                            @endif
                        </div> <!-- /.input-group -->
                            <div class="help-block text-center" id="inp_time_out-error"></div>
                    </div> <!-- /.form-group -->
                </div> <!-- /.bootstrap-timepicker -->
                
                <div class="box-footer">
                    <button class="btn btn-flat btn-primary btn-block">Submit</button>
                </div>
                
                <script>

                        // $('#inp_date_today').datepicker({
                        //     autoclose:true
                        // });

                    // $('.timepicker').timepicker({
                    //     showInputs: false,
                    //     minuteStep: 5
                    // });

                    $( ".timepicker" ).timeDropper({

                    // custom time format
                        format: 'hh:mm a',

                        // auto changes hour-minute or minute-hour on mouseup/touchend.
                        autoswitch: false,

                        // sets time in 12-hour clock in which the 24 hours of the day are divided into two periods. 
                        meridians: true,

                        // enable mouse wheel
                        mousewheel: true,

                        // auto set current time
                        setCurrentTime: true,

                        // fadeIn(default), dropDown
                        init_animation: "fadein",

                        // custom CSS styles
                        primaryColor: "#1977CC",
                        borderColor: "#a2a2a2", //"#1977CC",
                        backgroundColor: "#FFF",
                        textColor: '#555'
                    
                    });

                    $( "#inp_date_today" ).dateDropper();
                </script>