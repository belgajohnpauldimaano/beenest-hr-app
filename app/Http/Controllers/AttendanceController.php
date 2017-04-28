<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Crypt;
use Session;
use Auth;

use App\Attendance;
use App\User;
use App\Overtime;
use App\Leave;

class AttendanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //if (session('OTP')){
        //    return redirect()->action('UserController@verifyOtp');
        //}
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    //renders the view today 
    public function today () 
    {
        return view('attendance.today.index');
    }
 
    //renders log form via ajax post request
    public function log_form (Request $request) 
    {
        $Attendance = Attendance::where(function ($q) use($request){
            $q->where('user_id', Auth::user()->id);
            $q->where('date', date('Y-m-d', strtotime($request->input('date'))));
        })
        ->first();
        return view('attendance.today.log_form', ['attendance' => $Attendance, 'current_user_id' => Auth::user()->id, 'selected_date' => $request->input('date')])->render();
    }

    public function check_date_for_logs(Request $request)
    {
        $Attendance = Attendance::
                        where(function ($q) use($request) {
                            $q->where('user_id', decrypt($request->input('id')));
                            $q->where('date', date('Y-m-d', strtotime($request->input('date'))));
                        })
                        ->first();
        //return json_encode(['time_in' => $request->input('id'), 'time_out' => $Attendance]);
    }

    public function log_user (Request $request) 
    {
        $rules = [
            'inp_log_type'      => 'required',
            'inp_current_user'  => 'required'
        ];
        $messages = [
            'inp_log_type.required'         => 'Log type is invalid',
            'inp_current_user.required'     => 'Invalid user'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails())
        {
            return json_encode(['errRes' => 1, 'errMsg' => $validator->getMessageBag()]);
        }

        
        //return $request->input('inp_log_type');
        
        $log_type = decrypt($request->input('inp_log_type'));
        

        $rules = [
            'inp_date_today'      => 'required',
        ];
        $messages = [
            'inp_date_today.required'         => 'Date is required',
        ];

        if($log_type == 1)
        {
            $rules['inp_time_in'] = 'required';
            $messages['inp_time_in.required'] = 'Time in is required';
        }
        else
        {
            $rules['inp_time_out'] = 'required';//|date_format:H:i';
            $messages['inp_time_out.required'] = 'Time out is required';
        }

        $validator = Validator::make($request->all(), $rules, $messages);
        
        if($validator->fails())
        {
            return json_encode(['errRes' => 1, 'errMsg' => $validator->getMessageBag()]);
        }


        $user_id = ($request->input('inp_current_user'));
        $time = '';
        $log_date = date('Y-m-d', strtotime($request->input('inp_date_today')));

        
        if($log_type == 1)
        {

            $Attendance = new Attendance();
            $Attendance->date           = $log_date;
            $Attendance->user_id        = $user_id;
            $Attendance->approved       = 0;
            $Attendance->time_in        = date('H:i:s', strtotime($request->input('inp_time_in')));
            
            if($Attendance->save())
            {
                return json_encode(['errRes' => 0, 'Msg' => 'You have successfully logged in.']);
            }

        }
        else
        {

            $rules = null;
            $messages = null;

            $time_out = date('H:i:s', strtotime($request->input('inp_time_out')));
            
            $rules['time_out'] = 'required|date_format:H:i:s';
            $messages['time_out.required'] = 'Time out is required';
            $messages['time_out.date_format'] = 'Time out is incorrect format';
            $validator = Validator::make(['time_out' => $time_out], $rules, $messages);

            if($validator->fails())
            {
                return json_encode(['errRes' => 1, 'errMsg' => $validator->getMessageBag()]);
            }

            $Attendance = Attendance
                            ::where(function ( $q ) use($request, $log_date, $user_id) {
                                $q->where('user_id', $user_id);
                                $q->where('date', $log_date);
                            })
                            ->first()
                            ;
            if($Attendance->time_out == '' || $Attendance->time_out == '00:00:00' || $Attendance->time_out == 'NULL' )
            {
                //computation of total number of working hours including overtime hours - FORMULA :   ( ( (time_out - time_in) / 60 ) / 60 ) - return is decimal
                $totalHours = ( ( ( strtotime($request->input('inp_time_out')) - strtotime($Attendance->time_in) ) / 60 ) / 60 ) - 1; // minus 1 for the breaktime

                // getting the overtime hours in decimal format - FORMULA : ( total_hours - 8 ) - .50 - .50 is 30 minutes of breaktime for overtime
                $overtimeHours = round(( $totalHours - 8 ) - 0.50, 2);
               
                $Overtime                   = new Overtime();
                $Overtime->attendance_id    = $Attendance->id;
                $Overtime->overtime         = ( $overtimeHours >= 0.50 ? $overtimeHours : 0 ); // determine if the overtime exceeds 30 mins
                $Overtime->approved         = 0;
                $Overtime->save();
            
                $Attendance->time_out = $time_out;
                $Attendance->save();
                
                return json_encode(['errRes' => 0, 'Msg' => 'You have successfully logged out.']);
            }
            else
            {
                return json_encode(['errRes' => 2, 'errMsg' => 'you are already logged out.' ]);
            }

        }

    }

    /*
     * Leave action
     * 03-23-2017
     */
    public function leave() 
    {
        $User = User::all();
        return view('attendance.leave.index', ['users' => $User]);
    }

    public function leave_list (Request $request) 
    {
        $Leave = Leave::where('user_id', $request->input('user'))
                    ->orderBy('date_from', 'desc')
                    ->paginate(2);
        return view('attendance.leave.leave_data_list', ['leaves' => $Leave])->render();
    }
    
    public function delete_leave (Request $request) 
    {
        $validator = Validator::make($request->all(), 
            [
                'id'    => 'required'
            ],
            [
                'id.required'   => 'Invalid selection of user.'
            ]);

        if( $validator->fails() )
        {
            return json_encode(['errRes' => 1, 'errMsg' => $validator->getMessageBag() ]);
        }

        $leave_id = decrypt($request->input('id'));
        
        $Leave = Leave::where('id', $leave_id)->first();

        if($Leave == NULL)
        {
            return json_encode(['errRes' => 2, 'errMsg' => 'Leave record not found.' ]);
        }

        $Leave->delete();
        return json_encode(['errRes' => 0, 'Msg' => 'Leave successfully delete.' ]);
    }

    public function apply_leave () 
    {
        return view('attendance.leave.apply_leave');
    }

    public function request_leave (Request $request) 
    {
        $rules = [
            'select_leave_type'     =>'required|integer|between:1,4',
            'inp_date_from'         => 'required|date_format:m/d/Y',
            'inp_date_to'           => 'required|date_format:m/d/Y'
        ];

        $messages = [
            'select_leave_type.required'       => 'The leave type is required.',
            'select_leave_type.between'        => 'The leave type should be a valid selection.',
            'select_leave_type.integer'        => 'The leave type should be a valid selection.',
            'inp_date_from.required'            => 'The date from is required.',
            'inp_date_from.date_format'         => 'The date should be a valid format.',
            'inp_date_to.required'              => 'The date to is required.',
            'inp_date_to.date_format'           => 'The date should be a valid format.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) 
        {
            return json_encode(['errRes' => 1, 'errMsg' => $validator->getMessageBag()]);
        }

        $from = strtotime( $request->input('inp_date_from') );
        $to = strtotime( $request->input('inp_date_to') );

        if ($request->input('select_leave_type') % 2 == 0) 
        {
            if ( $from > $to  ) 
            {
                return json_encode(['errRes' => 2, 'errMsg' => 'The date from should not be greater than to date to.' ]);
            } 
        }

        $Leave = Leave::where( function($q) use ($from, $to) {
            $q->where('date_from', '>=', date('Y-m-d', $from));
            $q->where('date_to', '<=', date('Y-m-d', $to));
            $q->where('user_id', Auth::user()->id);
        })->get();
        
        if( $Leave->count() > 0 ) 
        {
            return json_encode(['errRes' => 2, 'errMsg' => 'You have pending leave with in the selected date you specified.' ]);
        }

        if ($request->input('select_leave_type') % 2 == 0)  // whole day
        {
            $Leave             = new Leave();
            $Leave->user_id    = Auth::user()->id;;
            $Leave->date_from  = date('Y-m-d', $from);
            $Leave->date_to    = date('Y-m-d', $to);
            $Leave->type       = ( $request->input('select_leave_type') == 2 ? 'SL - Wholeday' : 'VL - Wholeday');
            $Leave->approved   = 0;
            $Leave->save();   

            return json_encode(['errRes' => 0, 'msg' => 'Leave successfully placed.' ]);
        }
        else  // half day
        {
            $Leave             = new Leave();
            $Leave->user_id    = Auth::user()->id;;
            $Leave->date_from  = date('Y-m-d', $from);
            $Leave->date_to    = date('Y-m-d', $from);
            $Leave->type       = ( $request->input('select_leave_type') == 1 ? 'SL - Halfday' : 'VL - Halfday');
            $Leave->approved   = 0;
            $Leave->save();

            return json_encode(['errRes' => 0, 'msg' => 'Leave successfully placed.' ]);
        }

    }


    /*
     * Attendance Summary action
     * 03-28-2017
     */
     public function summary()
     {
        $User = User::all();
         return view('attendance.summary.index', ['users' => $User]);
     }

     public function summary_list(Request $request)
     {
        $Attendance = Attendance::with(['overtime'])->where(function ($q) use ($request) {
            $q->where('user_id', $request->input('user'));
        })
        ->orderBy('date', 'desc')
        ->paginate(10);

        return view('attendance.summary.data_list', ['attendances' => $Attendance])->render();
     }

     public function delete_attendance (Request $request) 
     {
        $id = decrypt($request->input('id'));
        //$id = ($request->input('id'));

        $validator = Validator::make($request->all(), [
                        'id'    => 'required'
                    ], 
                    [
                        'id.required' => 'Invalid selection.1'
                    ]);
        
        if($validator->fails())
        {
            return json_encode(['errRes' => 1, 'errMsg' => 'Invalid selection.' ]);
        }

        $Attendance = Attendance::where('id', $id)->first();

        if($Attendance == NULL)
        {
            return json_encode(['errRes' => 2, 'errMsg' => 'Invalid selection.' ]); 
        }

        $Overtime = Overtime::where('attendance_id', $id);

        if($Overtime != NULL)
        {
            $Overtime->delete();
        }

        $Attendance->delete();

        return json_encode(['errRes' => 0, 'Msg' => 'Attendance successfully deleted' ]); 
     }

}
