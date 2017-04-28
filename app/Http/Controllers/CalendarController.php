<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendance;
use App\User;
use App\Overtime;
use App\Leave;
use DB;
use Response;
use Auth;
use Session;

class CalendarController extends Controller
{
    
    public function __construct(){
        
        $this->middleware('auth');


    }

    public function calendar(){
        

        $sickleave = Leave::where(function ($q) {
            $q->where('user_id', Auth::user()->id);
            $q->where('approved', 1);
        })
        ->where(function($q){
            $q->where('type', 'SL - Halfday');
            $q->orWhere('type', 'SL - Wholeday');
        })
        ->count();
                
        Session::put('sickleave', $sickleave);
        
        $vacationleave = Leave::where(function ($q) {
            $q->where('user_id', Auth::user()->id);
            $q->where('approved', 1);
        })
        ->where(function($q){
            $q->where('type', 'VL - Halfday');
            $q->orWhere('type', 'VL - Wholeday');
        })
        ->count();
        Session::put('vacationleave', $vacationleave);

        $users = User::where('id', '!=', Auth::user()->id)->get();

        return view('calendar',compact('users'));

    }

    public function calendarUser(Request $request){

         $user = User::find($request->user_id)->attendances()->get(); // Attendance ORM

            $array = [];

            foreach($user as $q){

                    if($q->time_in == null){

                        $q->time_in = '00:00:00';

                    }

                    if($q->time_out == null){

                        $q->time_out = '00:00:00';

                    }


                    if($q->approved == 0){

                        $q->approved = 'times';

                    }

                    if($q->approved == 1){

                        $q->approved = 'check';

                    }

                        $array[] = array(

                            'title' => 'Attendance ',

                            'date' => $q->date,

                            'icon' => $q->approved,

                        );
                   
                        $array[] = array(

                            'icon' => 'sign-in',

                            'title' => ' ~ IN '.$q->time_in,

                            'date' => $q->date,

                        );

                        $array[] = array(

                            'icon' => 'sign-out',

                            'title' => ' ~ OUT '.$q->time_out,

                            'date' => $q->date,

                        );

                        $userOvertime = Attendance::find($q->id)->overtime()->get(); // Overtime ORM

                        if($userOvertime->count() > 0){

                            foreach($userOvertime as $overtime)
                            {
                                if($overtime->approved == 0)
                                {
                                    $overtime->approved = 'times';
                                }

                                if($overtime->approved == 1)
                                {
                                    $overtime->approved = 'check';
                                }
                                    $array[] = array(

                                    'icon' => $overtime->approved,

                                    'title' => 'Overtime ',

                                    'date' => $q->date,

                                );
                            }

                        }else{

                            $array[] = array(

                                'icon' => 'times',

                                'title' => 'Overtime ',

                                'date' => $q->date,

                            );

                        }
                        

            }

            $userLeave = User::find($request->user_id)->leaves()->get(); // Leave ORM

                        if($userLeave->count() > 0)
                        {
                            //$end = date('Y-m-d', strtotime($leave->date_to. ' + 1 day'));

                            foreach($userLeave as $leave)
                            {

                                if($leave->approved == 0)
                                {
                                    $leave->approved = 'leaf bg-grey';
                                }

                                if($leave->approved == 1)
                                {
                                    $leave->approved = 'leaf';
                                }
                                
                                $array[] = array(

                                    'icon' => $leave->approved,

                                    'title' => ' '.$leave->type,

                                    'start' => $leave->date_from,

                                    'end' => date('Y-m-d', strtotime($leave->date_to. ' + 1 day')),


                                );

                            }

                        }
        
            return $array;

    }

    public function index(){

         $user = User::find(Auth::user()->id)->attendances()->get();

         return Response::json($user, 200, [], JSON_PRETTY_PRINT);
    
    }


    public function calendarAdmin(Request $request){

         $user = User::find($request->user_id)->attendances()->get(); // Attendance ORM

            $array = [];

            foreach($user as $q){

                    if($q->time_in == null){

                        $q->time_in = '00:00:00';

                    }

                    if($q->time_out == null){

                        $q->time_out = '00:00:00';

                    }


                    if($q->approved == 0){

                        $q->approved = 'times';

                    }

                    if($q->approved == 1){

                        $q->approved = 'check';

                    }

                        $array[] = array(

                            'id' => $q->id,

                            'value' => $q->approved,

                            'title' => 'Attendance ',

                            'date' => $q->date,

                            'icon' => $q->approved,

                        );
                   
                        $array[] = array(

                            'icon' => 'sign-in',

                            'title' => ' ~ IN '.$q->time_in,

                            'date' => $q->date,

                        );

                        $array[] = array(

                            'icon' => 'sign-out',

                            'title' => ' ~ OUT '.$q->time_out,

                            'date' => $q->date,

                        );

                        $userOvertime = Attendance::find($q->id)->overtime()->get(); // Overtime ORM

                        if($userOvertime->count() > 0){

                            foreach($userOvertime as $overtime)
                            {
                                if($overtime->approved == 0)
                                {
                                    $overtime->approved = 'times';
                                }

                                if($overtime->approved == 1)
                                {
                                    $overtime->approved = 'check';
                                }
                                    $array[] = array(

                                    'id' => $overtime->id,

                                    'value' => $overtime->approved,

                                    'icon' => $overtime->approved,

                                    'title' => 'Overtime ',

                                    'date' => $q->date,

                                );
                            }

                        }
                        
                        // else{

                        //     $array[] = array(

                        //         'icon' => 'times',

                        //         'title' => 'Overtime ',

                        //         'date' => $q->date,

                        //     );

                        // }
                        

            }

            $userLeave = User::find($request->user_id)->leaves()->get(); // Leave ORM

                        if($userLeave->count() > 0)
                        {

                            foreach($userLeave as $leave)
                            {
                                $end = date('Y-m-d', strtotime($leave->date_to. ' + 1 day'));

                                if($leave->approved == 0)
                                {
                                    $leave->approved = 'leaf bg-grey';
                                }

                                if($leave->approved == 1)
                                {
                                    $leave->approved = 'leaf';
                                }
                                
                                $array[] = array(

                                    'id' => $leave->id,

                                    'value' => $leave->approved,

                                    'label' => 'Leave',

                                    'icon' => $leave->approved,

                                    'title' => ' '.$leave->type,

                                   'start' => $leave->date_from,

                                    'end' => $end,

                                );

                            }

                        }
        
            return $array;

    }

    public function isapproveAttendance(Request $request, $id){

        $attendance = Attendance::findOrFail($id);

        $attendance->approved = $request->approved;

        $attendance->save();

    }

    public function isapproveOvertime(Request $request, $id){

        $overtime = Overtime::findOrFail($id);

        $overtime->approved = $request->approved;
        
        $overtime->save();
        

    }

    public function isapproveLeave(Request $request, $id){

        $leave = Leave::findOrFail($id);

        $leave->approved = $request->approved;
        
        $leave->save();

    }
    
}
