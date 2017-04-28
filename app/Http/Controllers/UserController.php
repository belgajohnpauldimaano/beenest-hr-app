<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Support\Facades\Input;


//use App\Http\Requests\PaginationRequest;
use Auth;
use Route;

use App\User;
use App\UserMeta;
use App\MSG91;



class UserController extends Controller
{
    /**
     *
     * Avoid user who is not logged in.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->type != User::$types['Admin']){
            return redirect()->action('CalendarController@calendar');
        }
        
        $users = User::paginate(10);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->type != User::$types['Admin']){
            return redirect()->action('CalendarController@calendar');
        }

        $user_types = User::$types;
        return view('user.create', compact('user_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $user = new User;

        $user->employee_no = $request->employee_no;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->type = $request->type;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->start_date = $request->start_date;
        $user->end_date = $request->end_date;

        //dd($request);

        if ($user->save()) {

            if($request->hasFile('image')) {

                //resize image
                $image       = $request->file('image');
                $filename    = $image->getClientOriginalName();

                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(200,null, function ($constraint) {
                                    $constraint->aspectRatio();
                               });
                $image_resize->save(public_path('images/profile/' .$filename));

                //update user table
                $user->image = $filename;
                $user->save();

            }

            //save on user_meta table
            UserMeta::saveMeta($user->id, $request->meta);

            $messageType = 'alert-success';
            $message = 'New user successfully saved';

        } else {

            $messageType = 'alert-danger';
            $message = 'Error on saving';

        }

        return redirect()->action('UserController@index')->with($messageType, $message);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            abort(404);
        }

        $usermeta = array();

        foreach($user->usermeta as $key => $val){
            $usermeta[$val['key']] = $val['value'];
        }

        return view('user.show', compact('user', 'usermeta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            abort(404);
        }

        $user_types = User::$types;
        $usermeta = array();

        foreach($user->usermeta as $key => $val){
            $usermeta[$val['key']] = $val['value'];
        }

        return view('user.edit', compact('user', 'user_types', 'usermeta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (empty($user)) {
            abort(404);
        }

        $user->employee_no = $request->employee_no;
        $user->name = $request->name;
        $user->type = $request->type;
        $user->email = $request->email;
        $user->start_date = $request->start_date;
        $user->end_date = $request->end_date;

        if($request->password){
            $user->password = Hash::make($request->password);
        }

        if ($user->save()) {

            if($request->hasFile('image')) {
                //resize image
                $image       = $request->file('image');
                $filename    = $image->getClientOriginalName();

                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(200,null, function ($constraint) {
                                    $constraint->aspectRatio();
                               });
                $image_resize->save(public_path('images/profile/' .$filename));

                //update user table
                $user->image = $filename;
                $user->save();

            }

            //save on user_meta table
            UserMeta::saveMeta($user->id, $request->meta);

            $messageType = 'alert-success';
            $message = 'User successfully updated';

        } else {

            $messageType = 'alert-danger';
            $message = 'Error on saving';

        }

        return redirect()->action('UserController@index')->with($messageType, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        $messageType = 'alert-success';
        $message = 'User successfully deleted';

        return redirect()->action('UserController@index')->with($messageType, $message);
    }

    /**
    * Sending the OTP.
    *
    * @return Response
    */
    public function sendOtp(Request $request){

        $response = array();
        $userId = Auth::user()->id;

        $users = User::where('id', $userId)->first();

        if ( isset($users['mobile']) && $users['mobile'] =="" ) {
            $response['error'] = 1;
            $response['message'] = 'Invalid mobile number';
            $response['loggedIn'] = 1;
        } else {

            $otp = rand(100000, 999999);
            $MSG91 = new MSG91();

            $msg91Response = $MSG91->sendSMS($otp,$users['mobile']);

            if($msg91Response['error']){
                $response['error'] = 1;
                $response['message'] = $msg91Response['message'];
                $response['loggedIn'] = 1;
            }else{

                Session::put('OTP', $otp);

                $response['error'] = 0;
                $response['message'] = 'Your OTP is created.';
                $response['OTP'] = $otp;
                $response['loggedIn'] = 1;
            }
        }
        echo json_encode($response);
    }

    /**
    * Function to verify OTP.
    *
    * @return Response
    */
    public function verifyOtp(Request $request){

        // $response = array();

        // $enteredOtp = $request->input('otp');
        // $userId = Auth::user()->id;  //Getting UserID.

        // if($userId == "" || $userId == null){
        //     $response['error'] = 1;
        //     $response['message'] = 'You are logged out, Login again.';
        //     $response['loggedIn'] = 0;
        // }else{
        //     $OTP = $request->session()->get('OTP');
        //     if($OTP === $enteredOtp){

        //         // Updating user's status "isVerified" as 1.

        //         User::where('id', $userId)->update(['isVerified' => 1]);

        //         //Removing Session variable
        //         Session::forget('OTP');

        //         $response['error'] = 0;
        //         $response['isVerified'] = 1;
        //         $response['loggedIn'] = 1;
        //         $response['message'] = "Your Number is Verified.";
        //     }else{
        //         $response['error'] = 1;
        //         $response['isVerified'] = 0;
        //         $response['loggedIn'] = 1;
        //         $response['message'] = "OTP does not match.";
        //     }
        // }
        // echo json_encode($response);

        return view('user.verifyOtp');

    }


}
